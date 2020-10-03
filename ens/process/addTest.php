
<?php 

require_once("../../config/db.php");
require_once("../../models/Enseignant.php");
$ens  = new Enseignant();
$bool = $ens->ajouterTest($_POST);
if($bool){
    ?>
    <script>
        window.alert("Teste ajouté");
        window.location.href = "../index.php";

    </script>
    <?php 
}
?>