<?php 
require_once("../../config/db.php");
require_once("../../models/Enseignant.php");
if(Enseignant::delReponse($_GET["id"])){
    ?>
    <script>
        window.alert("Reponse supprimée");
        window.location.href = "../index.php";

    </script>
    <?php 
}
?>