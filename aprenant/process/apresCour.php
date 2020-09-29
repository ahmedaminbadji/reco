<?php 
require_once("../../config/db.php");
session_start();
$etat = $_POST["etat"];

$pdo = Config::getPdo();

$query = "SELECT * FROM `aprenant`  WHERE `id_utilisateur`=?";
$sql = $pdo->prepare($query);
$sql->execute([$_SESSION["id_user"]]);
$result = $sql->fetch(PDO::FETCH_ASSOC);
$ancierEtat = $result["last_emotion"];

                $query = "UPDATE `aprenant` SET `last_emotion`=? WHERE `id_utilisateur`=?";
                $sql = $pdo->prepare($query);
                $sql->execute([$etat,$_SESSION["id_user"]]);

echo $etat;
echo $ancierEtat;
if ($ancierEtat == 1 && $etat ==-1){
    header('Location: ../questionnaire2.html'); 
}else{
   // header('Location: ../index.php'); 
}                
?>