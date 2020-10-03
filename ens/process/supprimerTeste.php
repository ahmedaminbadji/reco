<?php 
require_once("../../config/db.php");
require_once("../../models/Enseignant.php");
if(Enseignant::delTeste($_GET["id"])){
    ?>
    <script>
        window.alert("Teste supprimé");
        window.location.href = "../index.php";

    </script>
    <?php 
}
?>