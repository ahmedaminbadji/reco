<?php 
require_once("../../config/db.php");
session_start();
$etat = $_POST["etat"];

$rating = $_POST["rating"];

$pdo = Config::getPdo();
                $query = "UPDATE `aprenant` SET `last_emotion`=? WHERE `id_utilisateur`=?";
                $sql = $pdo->prepare($query);
                $sql->execute([$etat,$_SESSION["id_user"]]);


if($etat == 1 && $rating >=3){
    //evaluation acc
}else{
    if($etat == -1 && $rating <3){
        
    //evaluation acc

}else{
    //return index
}
}         
?>