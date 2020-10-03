<?php 

require_once("../../config/db.php");
require_once("../../models/Enseignant.php");
$ens  = new Enseignant();
$bool = $ens->ajouterQuestion($_POST);
if($bool){
    ?>
    <script>
        window.alert("Question ajoutée");
        window.location.href = "../index.php";

    </script>
    <?php 
}
?>