<?php 
require_once("../../config/db.php");
require_once("../../models/Tuteur.php");
//$config = new Config();
//$pdo = Config::$pdo;
$user  = new Tuteur();
$bool = $user->editTuteur($_POST);
var_dump( $bool);
if($bool)
{
    //inscrit
    ?>
    <script>
        window.alert("Tuteur modifié");
        window.location.href = "../index.php";

    </script>
    <?php 
}
?>