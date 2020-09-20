<?php 
//include("../config/db.php");
class User 
{
    public $id;
    public  $nom ;
    public $prenom ;
     public $sexe;
     public $email;
     public $fac;
     public $dep;
     public $dateN;
     public $pseudo;
     public $mdp;
     public $image;
     public $type;
//null object
    function __construct() {
        $this->nom = null;
        $this->prenom = null;
         $this->sexe = null;
         $this->email = null;
         $this->fac = null;
         $this->dep = null;
         $this->dateN = null;
         $this->pseudo = null;
         $this->mdp = null;
         $this->image = null;
         $this->type = null;
    }
//Hash the password 
    private function hashPass($mdp){
        return password_hash($mdp, PASSWORD_DEFAULT);
    }
//Enode image before inserting to BDD
    private function getImage($i){
        //$path = $request->file('image')->getRealPath();
        //$temp = file_get_contents($path);
        $image = realpath($i["files"]["tmp_name"][0]);
        $name = $i["files"]["name"];
        $image = addslashes(file_get_contents($image));
        return $image;
    }
//set object proprities
    public function setup($post,$files){
        $this->nom = $post["inputName"];
        $this->prenom = $post["inputFname"];
        $this->sexe = $post["sexe"];
        $this->email = $post["inputEmail"];
        $this->fac = $post["inputFac"];
        $this->dep = $post["inputDep"];
        $this->dateN = $post["inputDateN"];
        $this->pseudo = $post["pseudo"];
        $this->mdp = $post["pass"];
        $this->image = $this->getImage($files);
        $c = $this->save();
        return $c;
    }
    private function save(){
       
        $pdo = Config::getPdo();
        $query = "INSERT INTO `users`(`nom`, `prenom`, `sexe`, `email`, `faculte`, `departement`, `date_naiss`, `pseudo`, `motpass`, `imageProf`) VALUES (?,?,?,?,?,?,?,?,?,?)";
        $sql = $pdo->prepare($query);
    $c =     $sql->execute([$this->nom,$this->prenom,$this->sexe,$this->email,$this->fac,$this->dep,$this->dateN,$this->pseudo,$this->hashPass($this->mdp),$this->image]);
    return $c;
    }
   
    public static function confirm($id)
    {
        $pdo = Config::getPdo();
        $query = "UPDATE  `users` SET `confirmed` = ?";
        $sql = $pdo->prepare($query);
    $c =     $sql->execute([1]);
    return $c;
    }
    public static function delete($id)
    {    $pdo = Config::getPdo();
        //DELETE FROM table_name WHERE some_column = some_value 
        $query = "DELETE FROM `users` WHERE `id_utilisateur` = ?";
        $sql = $pdo->prepare($query);
        $c = $sql->execute([$id]);
        return $c;
    }
}
?>