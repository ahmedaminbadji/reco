<?php 
require_once("../../config/db.php");
require_once("../../models/Tuteur.php");
//$config = new Config();
//$pdo = Config::$pdo;
$user  = new Tuteur();
$bool = $user->setup($_POST,$_FILES);
var_dump( $bool);
if($bool)
{
    //inscrit
    ?>
    <script>
        window.alert("Tuteur ajouté");
        window.location.href = "../index.php";

    </script>
    <?php 
}
?>