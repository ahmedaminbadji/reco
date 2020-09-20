<?php 
require_once("../../config/db.php");
require_once("../../models/Tuteur.php");
//$config = new Config();
//$pdo = Config::$pdo;
$user  = new Tuteur();
$bool = $user->editTuteur($_POST,$_FILES);
var_dump( $bool);
if($bool)
{
    //inscrit
}
?>