<?php
include("User.php");
class Admin extends User {

    function __construct() {
       parent::__construct();
    }
    public function setup($post){
        // parent::setup($post);
        // $this->type = "admin";
        // $pdo = Config::getPdo();
        


        // $query = "SELECT MAX( id_utilisateur ) AS max_id FROM users ";
        // $sql = $pdo->prepare($query);
        // $sql->execute();
        // $result = $sql->fetch(PDO::FETCH_ASSOC);
        // $this->id =  $result['max_id'];
    
        // $query = "UPDATE  `users` SET `type` = ? WHERE ?";
        // $sql = $pdo->prepare($query);
        // $sql->execute([$this->type,$this->id]);
   
    }

    public static function ajouterSpec($post)
    { 
        $pdo = Config::getPdo();
        $query = "INSERT INTO `specialite`( `nom_specialite`) VALUES (?)";
        $sql = $pdo->prepare($query);
        $c = $sql->execute([$post["nomSpecialite"]]);
        return $c;
    }

    public static function modifierSpec($post)
    { 
        $pdo = Config::getPdo();
        $query = "UPDATE  `specialite` SET `nom_specialite` = ? WHERE `id_specialite` = ? ";
        $sql = $pdo->prepare($query);
        $c = $sql->execute([$post["nomSpecialite"],$post["id"]]);
        return $c;
    }

    public static function ajouterModule($post){
        
        $pdo = Config::getPdo();
        $query = "INSERT INTO `module`( `nom_module`, `id_specialite`) VALUES (?,?)";
        $sql = $pdo->prepare($query);
        $c = $sql->execute([$post["nomModule"],$post["specialite"]]);
        return $c;
    }

    public static function modifierModule($post){
        
        $pdo = Config::getPdo();
        $query = "UPDATE `module` SET `nom_module`= ? , `id_specialite` = ? WHERE `id_module` = ?";
        $sql = $pdo->prepare($query);
        $c = $sql->execute([$post["nomModule"],$post["specialite"],$post["id"]]);
        return $c;
    }

    public static function delSpec($id)
    { 
        $pdo = Config::getPdo();
        $query = "DELETE FROM `specialite` WHERE `id_specialite` = ?";
        $sql = $pdo->prepare($query);
        $c = $sql->execute([$id]);
        return $c;
    }
    public static function delModule($id)
    { 
        $pdo = Config::getPdo();
        
        $query = "DELETE FROM `module` WHERE `id_module` = ?";
        $sql = $pdo->prepare($query);
        $c = $sql->execute([$id]);
        return $c;
    }
}