<?php 
require_once("../../config/db.php");
require_once("../../models/User.php");
if(User::confirm($_GET["id"])){
    ?>
    <script>
        window.alert("Aprenant confirmé");
        window.location.href = "../index.php";

    </script>
    <?php 
}
?>