<?php 
require_once("../../config/db.php");
require_once("../../models/Tuteur.php");
echo Tuteur::annulerDemande($_GET["id"]);
?>