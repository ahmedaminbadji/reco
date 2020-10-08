<?php 
require_once("../../config/db.php");
session_start();
$pdo = Config::getPdo();
$query = "INSERT INTO `messages`(`sender`, `reciver`, `message`, `date_msg`, `time_msg`) VALUES (?,?,?,?,?)";
$sql = $pdo->prepare($query);
echo $sql->execute([$_POST["sender"],$_POST["reciver"],$_POST["msg"],date("Y-m-d"),date("H:i:s")]);
//header('Location: ../index.php'); 
?>