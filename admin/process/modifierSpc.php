<?php 
require_once("../../config/db.php");
require_once("../../models/Admin.php");
//$config = new Config();
//$pdo = Config::$pdo;
$bool = Admin::modifierSpec($_POST);
var_dump( $bool);
if($bool)
{
    //inscrit
}
?>