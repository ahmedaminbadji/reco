<?php
include("User.php");
class Tuteur extends User {

    function __construct() {
       parent::__construct();
    }

    public function setup($post,$files){
        parent::setup($post,$files);
        $this->type = "tuteur";
        $pdo = Config::getPdo();
        


        $query = "SELECT MAX( id_utilisateur ) AS max_id FROM users ";
        $sql = $pdo->prepare($query);
        $sql->execute();
        $result = $sql->fetch(PDO::FETCH_ASSOC);
        $this->id =  $result['max_id'];
    
        $query = "UPDATE  `users` SET `type` = ? ,`confirmed`=?  WHERE `id_utilisateur` = ?";
        $sql = $pdo->prepare($query);
       $c1 = $sql->execute([$this->type,1,$this->id]);
   
        
        $query = "INSERT INTO `tuteur`(`id_utilisateur` ) VALUES (?)";
        $sql = $pdo->prepare($query);
        $c = $sql->execute([$this->id]);
        return $c && $c1;
        
    }
    public static function creeGroupe($post)
    {
        $pdo = Config::getPdo();
        $query = "INSERT INTO `groupe`(`nom_groupe` ) VALUES (?)";
        $sql = $pdo->prepare($query);
        $c = $sql->execute([$post["nomGroupe"]]);
        return $c ;
    }
    public static function delGroupe($id)
    {
        $pdo = Config::getPdo();
        $query = "DELETE FROM `groupe` WHERE `id_groupe`=?";
        $sql = $pdo->prepare($query);
        $c = $sql->execute([$id]);
        return $c ;
    }
    public static function editGroupe($post)
    {
        $pdo = Config::getPdo();
        $query = "UPDATE `groupe` SET `nom_groupe` = ? WHERE `id_groupe` = ?";
        $sql = $pdo->prepare($query);
        $c = $sql->execute([$post["nomGroupe"] , $post["id"]]);
        return $c ;
    }
    public static function approuverDemande($id){
        $c1 = False;
        $c = False;
        $pdo = Config::getPdo();
        $query = "SELECT * FROM `demande_groupe` WHERE  `id_demande`= ? ";
        $sql = $pdo->prepare($query);
        $c = $sql->execute([$id]);
        if($sql->rowCount()==1){
            $result = $sql->fetch(PDO::FETCH_ASSOC);
            $query = "UPDATE `aprenant` SET  `groupe_id`=? WHERE `id_utilisateur`= ?";
            $sql = $pdo->prepare($query);
            $c1 = $sql->execute([$result["id_groupe"],$result["id_utilisateur"]]);
            
            $query = "DELETE FROM `demande_groupe` WHERE  `id_demande`= ? ";
            $sql = $pdo->prepare($query);
            $c = $sql->execute([$id]);


        }
        return $c && $c1;
    }
    public static function annulerDemande($id){
        $query = "DELETE FROM `demande_groupe` WHERE  `id_demande`= ? ";
        $sql = $pdo->prepare($query);
        $c = $sql->execute([$id]);
        return $c;
    }
    
    public static function editTuteur($post,$files)
    {
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
            $query = "UPDATE  `users` SET `nom` = ? ,`prenom`=? , `sexe`=? , `email`=? , `faculte`=? , `departement`=? , `date_naiss`=? , `pseudo`=? , `motpass`=? , `imageProf` = ? WHERE `id_utilisateur` = ?";
       $sql = $pdo->prepare($query);
       $c = $sql->execute([ $nom ,$prenom ,$sexe ,$email ,$fac ,$dep ,$dateN ,$pseudo , $mdp , $image , $post["id"] ]);
        }
        return $c;
    }
    
}

?>