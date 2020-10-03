<?php 
require_once("../config/db.php");
require_once("../models/Aprenant.php");
//$config = new Config();
//$pdo = Config::$pdo;
$user  = new Aprenant();
$bool = $user->setup($_POST);
if($bool)
{
    //inscrit
}
?>