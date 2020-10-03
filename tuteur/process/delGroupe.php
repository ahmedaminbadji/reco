
<?php 
require_once("../../config/db.php");
require_once("../../models/Tuteur.php");
if(Tuteur::delGroupe($_GET["id"])){
    ?>
    <script>
        window.alert("Groupe supprimé");
        window.location.href = "../index.php";

    </script>
    <?php 
}
?>