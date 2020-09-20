<?php 
require_once("../../config/db.php");
require_once("../../models/User.php");
echo User::confirm($_GET["id"]);
?>