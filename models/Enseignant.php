<?php
require_once("User.php");
class Enseignant extends User {
    public $grade;

    function __construct() {
       parent::__construct();
       $this->grade = null;
    }

    public function setup($post){
        $c =parent::setup($post);
        $this->grade = $post["grade"];
        $this->type = "ens";
        $pdo = Config::getPdo();
       

        $query = "SELECT MAX( id_utilisateur ) AS max_id FROM users ";
        $sql = $pdo->prepare($query);
        $sql->execute();
        $result = $sql->fetch(PDO::FETCH_ASSOC);
        $this->id =  $result['max_id'];
        
        $query = "UPDATE  `users` SET `type` = ? ,`confirmed`=?  WHERE `id_utilisateur` = ?";
        $sql = $pdo->prepare($query);
        $sql->execute([$this->type,1,$this->id]);
        
        $query = "INSERT INTO `enseignent`(`grade_ens`,`id_utilisateur` ) VALUES (?,?)";
        $sql = $pdo->prepare($query);
        $c1 = $sql->execute([$this->grade,$this->id]);
        return $c1 && $c;

        
    }
    public static function delete($id)
    {    $pdo = Config::getPdo();
        //DELETE FROM table_name WHERE some_column = some_value 
        $query = "DELETE FROM `enseignent` WHERE `id_utilisateur` = ?";
        $sql = $pdo->prepare($query);
        $c = $sql->execute([$id]);
        return $c;
    }
    public static function ajouterDoc($post,$files)
    {
        $nomOrigine = $files['file']['name'];
        $elementsChemin = pathinfo($nomOrigine[0]);
        $extensionFichier = $elementsChemin['extension'];
        if ($extensionFichier != "pdf"){
            echo "Le fichier n'a pas l'extension attendue";
        } else {  
              // Copie dans le repertoire du script avec un nom
            // incluant l'heure a la seconde pres 
            $repertoireDestination = dirname(__FILE__)."/../upload"."/";
            $nomDestination = "fichier_du_".date("YmdHis").".".$extensionFichier;
    if (move_uploaded_file($_FILES["file"]["tmp_name"][0], 
    $repertoireDestination.$nomDestination)) {
echo "Le fichier temporaire ".$files["file"]["tmp_name"][0].
" a été déplacé vers ".$repertoireDestination.$nomDestination;
} else {
echo "Le fichier n'a pas été uploadé (trop gros ?) ou ".
"Le déplacement du fichier temporaire a échoué".
" vérifiez l'existence du répertoire ".$repertoireDestination;
}

        }
      
        //upload fichier
        $emplacement = $nomDestination;
        $pdo = Config::getPdo();
        $query = "INSERT INTO `document`(`type_document`,`emplacement`,`id_module` ) VALUES (?,?,?)";
        $sql = $pdo->prepare($query);
        $c1 = $sql->execute([$post["typeCours"],$emplacement,$post["module"]]);
        return $c1 ;
    }
    public static function ajouterDocSup($post,$files)
    {
        $nomOrigine = $files['file']['name'];
        $elementsChemin = pathinfo($nomOrigine[0]);
        $extensionFichier = $elementsChemin['extension'];
        if ($extensionFichier != "pdf"){
            echo "Le fichier n'a pas l'extension attendue";
        } else {  
              // Copie dans le repertoire du script avec un nom
            // incluant l'heure a la seconde pres 
            $repertoireDestination = dirname(__FILE__)."/../upload"."/";
            $nomDestination = "fichier_du_".date("YmdHis").".".$extensionFichier;
    if (move_uploaded_file($_FILES["file"]["tmp_name"][0], 
    $repertoireDestination.$nomDestination)) {
echo "Le fichier temporaire ".$files["file"]["tmp_name"][0].
" a été déplacé vers ".$repertoireDestination.$nomDestination;
} else {
echo "Le fichier n'a pas été uploadé (trop gros ?) ou ".
"Le déplacement du fichier temporaire a échoué".
" vérifiez l'existence du répertoire ".$repertoireDestination;
}

        }
      
        //upload fichier
        $emplacement = $nomDestination;
        $pdo = Config::getPdo();
        $query = "INSERT INTO `document_sup`(`emplacement`,`doc_principale` ) VALUES (?,?)";
        $sql = $pdo->prepare($query);
        $c1 = $sql->execute([$emplacement,$post["id"]]);
        return $c1 ;
    }
    public static function delDoc($id)
    {
        echo $id;
        $pdo = Config::getPdo();
        $query = "SELECT * FROM document WHERE id_document = ?";
        $sql = $pdo->prepare($query);
        $sql->execute([$id]);
        $result = $sql->fetch(PDO::FETCH_ASSOC);
        $c1 = unlink("../../upload/".$result["emplacement"]);


        
        //DELETE FROM table_name WHERE some_column = some_value 
        $query = "DELETE FROM `document` WHERE `id_document` = ?";
        $sql = $pdo->prepare($query);
        $c = $sql->execute([$id]);
        return $c && $c1;
    }
    public static function ajouterTest($post)
    {
        $pdo = Config::getPdo();
        $query = "INSERT INTO `teste`(`type_teste`, `module` ) VALUES (?,?)";
        $sql = $pdo->prepare($query);
        $c1 = $sql->execute([$post["typeTeste"],$post["module"]]);
        return $c1 ;
    }
    public static function modifierTest($post)
    {
        $pdo = Config::getPdo();
        $query = "UPDATE `teste`SET `type_teste` = ? , `module` = ? WHERE id_teste = ?";
        $sql = $pdo->prepare($query);
        $c1 = $sql->execute([$post["typeTeste"],$post["module"],$post["id"]]);
        return $c1 ;
    }
    public static function delTeste($id)
    {
        $pdo = Config::getPdo();
        $query = "DELETE FROM `teste` WHERE `id_teste` = ?";
        $sql = $pdo->prepare($query);
        $c1 = $sql->execute([$id]);
        return $c1 ;
    }
    public static function ajouterQuestion($post)
    {
        $pdo = Config::getPdo();
        $query = "INSERT INTO `question`(`question_text`,`id_teste`) VALUES (?,?)";
        $sql = $pdo->prepare($query);
        $c1 = $sql->execute([$post["questText"],$post["id"]]);
        return $c1 ;
    }
    public static function delQuestion($id)
    {
        $pdo = Config::getPdo();
        $query = "DELETE FROM `question` WHERE `id_question` = ? ";
        $sql = $pdo->prepare($query);
        $c1 = $sql->execute([$id]);
        return $c1 ;
    }
    public static function ajouterReponse($post)
    {
        $pdo = Config::getPdo();
        $query = "INSERT INTO `reponse`(`reponse_text`,`id_question` , `valeur`) VALUES (?,?,?)";
        $sql = $pdo->prepare($query);
        $c1 = $sql->execute([$post["reponse"],$post["id"],$post["valeur"]]);
        return $c1 ;
    }
    public static function delReponse($id)
    {
        $pdo = Config::getPdo();
        $query = "DELETE FROM `reponse` WHERE `id_reponse` = ? ";
        $sql = $pdo->prepare($query);
        $c1 = $sql->execute([$id]);
        return $c1 ;
    }
    public static function editEns($post){
        $pdo = Config::getPdo();
        $query = "SELECT * FROM users WHERE id_utilisateur = ?";
        $sql = $pdo->prepare($query);
        $sql->execute([$post["id"]]);
        $result = $sql->fetch(PDO::FETCH_ASSOC);
        $nom = $result["nom"];
        $prenom = $result["prenom"];
        $sexe  = $result["sexe"];
        $email = $result["email"];
        $fac = $result["faculte"];
        $dep = $result["departement"];
        $dateN = $result["date_naiss"];
        $pseudo = $result["pseudo"];
        $mdp = $result["motpass"];


        if(!empty($post["inputName"])){
            $nom = $post["inputName"];
        }
       if(!empty($post["inputFname"])){
        $prenom = $post["inputFname"];
       }
       if(!empty($post["sexe"])){
        $sexe = $post["sexe"];
       }
       if(!empty($post["inputEmail"])){
        $email = $post["inputEmail"];
       }
       if(!empty($post["inputFac"])){
        $fac = $post["inputFac"];
       }
       if(!empty($post["inputDep"])){
        $dep = $post["inputDep"];
       }
       if(!empty($post["inputDateN"])){
        $dateN = $post["inputDateN"];
       }
       if(!empty($post["pseudo"])){
        $pseudo = parent::hashPass($post["pseudo"]);
       }
       if(!empty($post["pass"])){
        $mdp = $post["pass"];
       }

       
       
       
       if($files["files"]["error"] != 0) {
        //stands for any kind of errors happen during the uploading
        $query = "UPDATE  `users` SET `nom` = ? ,`prenom`=? , `sexe`=? , `email`=? , `faculte`=? , `departement`=? , `date_naiss`=? , `pseudo`=? , `motpass`=? WHERE `id_utilisateur` = ?";
       $sql = $pdo->prepare($query);
       $c = $sql->execute([ $nom ,$prenom ,$sexe ,$email ,$fac ,$dep ,$dateN ,$pseudo , $mdp,$post["id"] ]);
        } else{
            $image = parent::getImage($files);
            $query = "UPDATE  `users` SET `nom` = ? ,`prenom`=? , `sexe`=? , `email`=? , `faculte`=? , `departement`=? , `date_naiss`=? , `pseudo`=? , `motpass`=?  WHERE `id_utilisateur` = ?";
       $sql = $pdo->prepare($query);
       $c = $sql->execute([ $nom ,$prenom ,$sexe ,$email ,$fac ,$dep ,$dateN ,$pseudo , $mdp  , $post["id"] ]);
        }

        $query = "UPDATE  `enseignent` SET `grade_ens` = ?  WHERE `id_utilisateur` = ?";
        $sql = $pdo->prepare($query);
        $c1 = $sql->execute([ $post["grade"],$post["id"] ]);
       
        return $c && $c1;
    }


    
}


?>