<?php 
require_once("../../config/db.php");
require_once("../../models/User.php");
if(User::delete($_GET["id"])){
    ?>
    <script>
        window.alert("Enseignant supprimé");
        window.location.href = "../index.php";

    </script>
    <?php 
}
?>