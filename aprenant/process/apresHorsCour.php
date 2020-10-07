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
    $query = "SELECT * FROM `document_hors_cours` WHERE `id_document`=?";
    $sql = $pdo->prepare($query);
    $sql->execute([$_SESSION["cour_actuel"]]);
    $result = $sql->fetch(PDO::FETCH_ASSOC);
    $ev = $result["evaluation"] * $result["nb_evaluation"];
    echo "ev ". $ev;
    $nb = $result["nb_evaluation"] + 1;
    $ev = $ev + $_POST["rating"];
    echo "new ev ". $ev;
    $ev = $ev / $nb;
    echo "new w ev ". $ev;

    
    $query = "UPDATE `document_hors_cours` SET `evaluation` = ? , `nb_evaluation` = ? WHERE `id_document`=?";
    $sql = $pdo->prepare($query);
    header('Location: ../index.php'); 
}else{
    if($etat == -1 && $rating <3){
        
    //evaluation acc
    $query = "SELECT * FROM `document_hors_cours` WHERE `id_document`=?";
    $sql = $pdo->prepare($query);
    $sql->execute([$_SESSION["cour_actuel"]]);
    $result = $sql->fetch(PDO::FETCH_ASSOC);
    $ev = $result["evaluation"] * $result["nb_evaluation"];
    $nb = $result["nb_evaluation"] + 1;
    $ev = $ev + $_POST["rating"];
    $ev = $ev / $nb;
    $query = "UPDATE `document_hors_cours` SET `evaluation` = ? , `nb_evaluation` = ? WHERE `id_document`=?";
    $sql = $pdo->prepare($query);
    $sql->execute([$ev,$nb,$_SESSION["cour_actuel"]]);
    header('Location: ../index.php'); 

}else{
    //return index
    header('Location: ../index.php'); 
}
}         
?>