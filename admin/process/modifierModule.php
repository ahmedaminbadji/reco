<?php 
require_once("../../config/db.php");
require_once("../../models/Admin.php");
//$config = new Config();
//$pdo = Config::$pdo;
$bool = Admin::modifierModule($_POST);
var_dump( $bool);
if($bool)
{
    //inscrit
    ?>
    <script>
        window.alert("Module modifié");
        window.location.href = "../index.php";

    </script>
    <?php 
}
?>