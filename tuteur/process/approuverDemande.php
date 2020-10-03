<?php 
require_once("../../config/db.php");
require_once("../../models/Tuteur.php");
if(Tuteur::approuverDemande($_GET["id"])){
    ?>
    <script>
        window.alert("Demande aprouvée");
        window.location.href = "../index.php";

    </script>
    <?php 
}
?>