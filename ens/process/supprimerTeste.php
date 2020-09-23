<?php 
require_once("../../config/db.php");
require_once("../../models/Enseignant.php");
echo Enseignant::delTeste($_GET["id"]);
?>