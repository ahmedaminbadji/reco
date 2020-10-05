<?php 


require_once("../config/db.php");
session_start();
?>

<div class="container-fluid">
<ul class="nav nav-tabs" role="tablist">
    <li class="nav-item nav-link active" ><a role="tab" aria-controls="ajoutDoc" aria-selected="true" data-toggle="tab"  href="#docCours">Documents du cours </a></li>
    <li><a data-toggle="tab" class="nav-item nav-link"  href="#docHorsCour">Documents hors cours   </a></li>
</ul>
<div class="tab-content">

                    <div id="docCours" class="tab-pane fade show active">

    <?php 
        $i=0;
        $pdo = Config::getPdo();
        if(isset($_SESSION["cour_actuel"])){
          $query2 = "UPDATE `aprenant` SET `cour_reco`=? WHERE `id_utilisateur`=?";
          $sql2 = $pdo->prepare($query2);
          $sql2->execute([$_SESSION["cour_actuel"],$_SESSION["id_user"]]);
  
  
          $query = "SELECT * FROM document_sup WHERE doc_principale = ?";
          $sql = $pdo->prepare($query);
          $sql->execute([$_SESSION["cour_actuel"]]);
          $result = $sql->fetchAll(PDO::FETCH_ASSOC);
        }else{
          $query = "SELECT * FROM document_sup WHERE doc_principale = (SELECT cour_reco FROM aprenant WHERE id_utilisateur= ?)";
          $sql = $pdo->prepare($query);
          $sql->execute([$_SESSION["id_user"]]);
          $result = $sql->fetchAll(PDO::FETCH_ASSOC);
          $_SESSION["cour_actuel"] = $result[0]["doc_principale"];
        }
       
        foreach($result as $row) {
            if($i==0){

           
    ?>
    <div class="row">
        <?php 
         }
        ?>
        <div class="col-md-3">
            <div class="card">
            <div class="card-body">
                <h4 class="card-title">
                    <?php 
                          $query = "SELECT * FROM document WHERE id_document = ?";
                          $sql = $pdo->prepare($query);
                          $sql->execute([$_SESSION["cour_actuel"]]);
                          $result2 = $sql->fetch(PDO::FETCH_ASSOC);
                        $id_module = $result2["id_module"];
                        $query = "SELECT * FROM module WHERE id_module = ?";
                        $sql = $pdo->prepare($query);
                        $sql->execute([$id_module]);
                        $result2 = $sql->fetch(PDO::FETCH_ASSOC);
                        echo $result2["nom_module"];
                    ?>
                </h4>
                <p class="card-text">Document supplémentaire</p>
                <a href="../pdf.php?path=<?php echo $row["emplacement"] ?>" class="btn btn-primary">Consulter Document</a>
            </div>
            </div>
        <?php $i++;?>
        </div>
        <?php   if($i==4){

           
?>
    </div>
    <?php 
         $i=0; }
        
        ?>
    <?php 
                                          }
             ?>

</div>
</div>
<div id="docHorsCour" class="tab-pane fade">

<?php 
        $i=0;
    
  
  
          $query = "SELECT * FROM document_hors_cours WHERE 1 LIMIT 0, 5 ORDER BY evaluation DESC";
          $sql = $pdo->prepare($query);
          $sql->execute();
          $result = $sql->fetchAll(PDO::FETCH_ASSOC);
foreach($result as $row) {
            if($i==0){

           
    ?>
    <div class="row">
        <?php 
         }
        ?>
        <div class="col-md-3">
            <div class="card">
            <div class="card-body">
                <h4 class="card-title">
                    <?php 
                        
                        $id_module = $result["id_module"];
                        $query = "SELECT * FROM module WHERE id_module = ?";
                        $sql = $pdo->prepare($query);
                        $sql->execute([$id_module]);
                        $result2 = $sql->fetch(PDO::FETCH_ASSOC);
                        echo $result2["nom_module"];
                    ?>
                </h4>
                <p class="card-text">Document supplémentaire</p>
                <a href="../pdf.php?path=<?php echo $row["emplacement"] ?>" class="btn btn-primary">Consulter Document</a>
            </div>
            </div>
        <?php $i++;?>
        </div>
        <?php   if($i==4){

           
?>
    </div>
    <?php 
         $i=0; }
        
        ?>
    <?php 
                                          }
             ?>

</div>
</div>

                    </div>
                  
  