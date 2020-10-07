<?php 

require_once("../../config/db.php");
require_once("../../models/Enseignant.php");

$ap  = new Aprenant();
if(isset($_GET["id"])){
    $bool = $ap->demandeGroupe($id);
    if($bool){
        ?>
        <script>
            window.alert("Demande déposée");
            window.location.href = "../index.php";
    
        </script>
        <?php 
    }
}
?>