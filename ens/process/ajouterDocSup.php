<?php 

require_once("../../config/db.php");
require_once("../../models/Enseignant.php");
$ens  = new Enseignant();
$bool = $ens->ajouterDocSup($_POST,$_FILES);
if($bool){
    ?>
    <script>
        window.alert("Document ajouté");
        window.location.href = "../index.php";

    </script>
    <?php 
}
?>