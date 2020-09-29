<div class="container-fluid">

    <h3>Tout les documents du cours: </h3>
    <?php 
    require_once("../config/db.php");
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
                                        
<br><br>
<div class="container-fluid">

<h3>Tout les documents hors cours: </h3>   

<?php 
        $query = "SELECT * FROM document WHERE type_document in(?,?)";
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
                <a href="../fer/pdf.php?path=<?php echo $row["emplacement"] ?>&&id=<?php echo $row["id_document"] ?>" class="btn btn-primary">Consulter Document</a>
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