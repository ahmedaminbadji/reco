<?php 
require_once("../../config/db.php");
require_once("../../models/Enseignant.php");
//$config = new Config();
//$pdo = Config::$pdo;
$user  = new Enseignant();
$bool = $user->editEns($_POST,$_FILES);
var_dump( $bool);
if($bool)
{
    //inscrit
}
?>