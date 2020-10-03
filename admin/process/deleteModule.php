<?php 
require_once("../../config/db.php");
require_once("../../models/Admin.php");
if(Admin::delModule($_GET["id"])){
    ?>
    <script>
        window.alert("Module supprimé");
        window.location.href = "../index.php";

    </script>
    <?php 
}
?>