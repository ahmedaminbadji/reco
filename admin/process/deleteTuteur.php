<?php 
require_once("../../config/db.php");
require_once("../../models/User.php");
echo User::delete($_GET["id"]);
?>