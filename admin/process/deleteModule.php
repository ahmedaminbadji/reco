<?php 
require_once("../../config/db.php");
require_once("../../models/Admin.php");
echo Admin::delModule($_GET["id"]);
?>