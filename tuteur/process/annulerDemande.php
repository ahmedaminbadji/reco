<?php 
require_once("../../config/db.php");
require_once("../../models/Tuteur.php");
if(uteur::annulerDemande($_GET["id"])){
    ?>
    <script>
        window.alert("Demande annulée");
        window.location.href = "../index.php";

    </script>
    <?php 
}
?>