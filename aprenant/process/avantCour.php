<?php 
require_once("../../config/db.php");
$etat = $_POST["etat"];
$path = $_POST["path"];
$pdo = Config::getPdo();
                $query = "UPDATE `aprenant` SET `last_emotion`=? WHERE `id_utilisateur`=?";
                $sql = $pdo->prepare($query);
                $c = $sql->execute([$etat,$_SESSION["id_user"]]);
if($c){
    header('Location: ../../pdf.php?path='.$path); 
}
?>