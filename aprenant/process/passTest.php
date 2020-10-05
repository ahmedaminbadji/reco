<?php 

require_once("../../config/db.php");
session_start();
$id = $_POST["id"];
var_dump($_POST);
$pdo = Config::getPdo();
$query = "SELECT * FROM question WHERE  id_teste = ?";
$sql = $pdo->prepare($query);
$sql->execute([$id]);
$n = $sql->rowCount();
$total = 0;
for($i=1;$i<=$n;$i++){
    if(isset($_POST["qst".$i])){

        $total+=$_POST["qst".$i];
    }
}
$note = ($total/$n)*20;

$query = "INSERT INTO `resultat`(`aprenant`, `test`, `note`) VALUES ((SELECT `id_aprenant` FROM `aprenant` WHERE `id_utilisateur`= ?),?,?)";
$sql = $pdo->prepare($query);
$sql->execute([$_SESSION["id_user"],$id,$note]);
//header('Location: ../index.php'); 
?>