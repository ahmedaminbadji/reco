<?php 
    require_once("../config/db.php");
    ?>

<ul class="nav nav-tabs" role="tablist">
    <li class="nav-item nav-link active" ><a role="tab" aria-controls="ajoutDoc" aria-selected="true" data-toggle="tab"  href="#docCours">Documents du cours </a></li>
    <li><a data-toggle="tab" class="nav-item nav-link"  href="#docHorsCour">Documents hors cours   </a></li>
</ul>
<div class="tab-content">

                    <div id="docCours" class="tab-pane fade show active">
                    <br>
                    <?php 
        $i=0;
        $pdo = Config::getPdo();
        $query = "SELECT * FROM document WHERE NOT type_document in(?,?)";
        $sql = $pdo->prepare($query);
        $sql->execute(["livre","tuto"]);
        $result = $sql->fetchAll(PDO::FETCH_ASSOC);
        foreach($result as $row) {
            if($i==0){

           
    ?>
    <div class="row">
        <?php 
         }
        ?>
        <div class="col-md-3 d-flex align-items-stretch">
            <div class="card h-100">
            <div class="card-body">
                <h4 class="card-title">
                    <?php 
                        
                        $query = "SELECT * FROM module WHERE id_module = ?";
                        $sql = $pdo->prepare($query);
                        $sql->execute([$row["id_module"]]);
                        $result2 = $sql->fetch(PDO::FETCH_ASSOC);
                        echo $result2["nom_module"];
                    ?>
                </h4>
                <p class="card-text"><?php echo $row["type_document"]; ?></p>
                <a href="../fer/avantCour.php?path=<?php echo $row["emplacement"] ?>&&id=<?php echo $row["id_document"] ?>" class="btn btn-primary">Consulter Document</a>
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
                    <br>


<?php 
        $query = "SELECT * FROM document WHERE type_document in(?,?)";
        $sql = $pdo->prepare($query);
        $sql->execute(["livre","tuto"]);
        $result = $sql->fetchAll(PDO::FETCH_ASSOC);
        $j = 0;
        foreach($result as $row) {
            if($j==0){

           
    ?>
    <div class="row">
        <?php 
         }
        ?>
        <div class="col-md-3 d-flex align-items-stretch">
            <div class="card h-100">
            <div class="card-body">
                <h4 class="card-title">
                    <?php 
                        
                        $query = "SELECT * FROM module WHERE id_module = ?";
                        $sql = $pdo->prepare($query);
                        $sql->execute([$row["id_module"]]);
                        $result2 = $sql->fetch(PDO::FETCH_ASSOC);
                        echo $result2["nom_module"];
                    ?>
                </h4>
                <p class="card-text"><?php echo $row["type_document"]; ?></p>
                <a href="../fer/pdf.php?path=<?php echo $row["emplacement"] ?>&&id=<?php echo $row["id_document"] ?>" class="btn btn-primary">Consulter Document</a>
            </div>
            </div>
        <?php $j++;?>
        </div>
        <?php   if($j==4){

           
?>
    </div>
    <?php 
         $i=0; }
        
        ?>
    <?php 
                                          }
                                        ?>
                                        </div>
