<?php 

require_once("../../config/db.php");
require_once("../../models/Enseignant.php");
$ens  = new Enseignant();
$bool = $ens->ajouterDoc($_POST,$_FILES);
echo $bool;
?>