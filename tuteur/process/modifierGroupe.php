<?php 
require_once("../../config/db.php");
require_once("../../models/Tuteur.php");
//$config = new Config();
//$pdo = Config::$pdo;

$bool = Tuteur::editGroupe($_POST);
var_dump( $bool);
if($bool)
{
    //inscrit
}
?>