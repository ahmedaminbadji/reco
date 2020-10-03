<?php 
require_once("../../config/db.php");
require_once("../../models/Enseignant.php");
if(Enseignant::delDoc($_GET["id"])){
    ?>
    <script>
        window.alert("Document supprimé");
        window.location.href = "../index.php";

    </script>
    <?php 
}
?>