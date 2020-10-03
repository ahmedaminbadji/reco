<?php 
require_once("../../config/db.php");
require_once("../../models/Enseignant.php");
if(Enseignant::delQuestion($_GET["id"])){
    ?>
    <script>
        window.alert("Question supprimée");
        window.location.href = "../index.php";

    </script>
    <?php 
}
?>