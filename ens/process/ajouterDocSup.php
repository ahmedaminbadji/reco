<?php 

require_once("../../config/db.php");
require_once("../../models/Enseignant.php");
$ens  = new Enseignant();
$bool = $ens->ajouterDocSup($_POST,$_FILES);
echo $bool;
?>