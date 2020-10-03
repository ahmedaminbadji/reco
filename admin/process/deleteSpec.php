<?php 
require_once("../../config/db.php");
require_once("../../models/Admin.php");
if(Admin::delSpec($_GET["id"])){
    ?>
    <script>
        window.alert("Spécialité supprimée");
        window.location.href = "../index.php";

    </script>
    <?php 
}
?>