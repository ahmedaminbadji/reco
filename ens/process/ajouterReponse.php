<?php 

require_once("../../config/db.php");
require_once("../../models/Enseignant.php");
$ens  = new Enseignant();
$bool = $ens->ajouterReponse($_POST);
if($bool){
    ?>
    <script>
        window.alert("Reponse ajoutée");
        window.location.href = "../index.php";

    </script>
    <?php 
}
?>