<?php 
//require_once("../config/db.php");
require_once("../models/Auth.php");
$result = Auth::authenticate($_POST["inputUser"],$_POST["inputPassword"]);
echo $result;
?>