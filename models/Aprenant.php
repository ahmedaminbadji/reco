<?php
require_once("User.php");
class Aprenant extends User {
    public $niveau;
    public $matricule;

    function __construct() {
       parent::__construct();
       $this->niveau = null;
       $this->matricule = null;
    }

    public function setup($post){
        $c = parent::setup($post);
        $this->niveau = $post["niv"];
        $this->matricule = $post["matricule"];
        
        $this->type = "aprenant";
        $pdo = Config::getPdo();
        
        $query = "SELECT MAX( id_utilisateur ) AS max_id FROM users ";
        $sql = $pdo->prepare($query);
        $sql->execute();
        $result = $sql->fetch(PDO::FETCH_ASSOC);
        $this->id =  $result['max_id'];
    
        $query = "UPDATE  `users` SET `type` = ? WHERE `id_utilisateur` = ?";
        $sql = $pdo->prepare($query);
        $cc =    $sql->execute([$this->type,$this->id]);
        
        $query = "INSERT INTO `aprenant`(`niveau`,`matricule`,`id_utilisateur` ) VALUES (?,?,?)";
        $sql = $pdo->prepare($query);
        $c1 = $sql->execute([$this->niveau,$this->matricule,$this->id]);
        return $c1 && $c;
        
    }
    public function demandeGroupe($id){
        $pdo = Config::getPdo();
        
        $query = "INSERT INTO demande_groupe (`id_utilisateur`,`id_groupe`) VALUES(?,?)";
        $sql = $pdo->prepare($query);
        return $sql->execute([$_SESSION["id_user"],$id]);

    }
}

?>