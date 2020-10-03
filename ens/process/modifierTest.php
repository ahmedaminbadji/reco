<?php 

require_once("../../config/db.php");
require_once("../../models/Enseignant.php");
$ens  = new Enseignant();
$bool = $ens->modifierTest($_POST);
if($bool){
    ?>
    <script>
        window.alert("Teste modifié");
        window.location.href = "../index.php";

    </script>
    <?php 
}
?>