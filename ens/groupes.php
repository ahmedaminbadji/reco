<?php 
    include("../config/db.php");
    session_start();
    if(isset($_SESSION["role"]) && $_SESSION["role"] == "ens"){

?>
<div class="container">
<div class="container">
                        
                        <div class="table-responsive">
                            <table id="productsTable" class="table table-bordered" style="text-align:center">
                                <thead>
                                    <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Nom Groupe</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php 
                                          $pdo = Config::getPdo();
                                          $query = "SELECT * FROM groupe WHERE  ?";
                                          $sql = $pdo->prepare($query);
                                          $sql->execute([1]);
                                          $result = $sql->fetchAll(PDO::FETCH_ASSOC);
                                          foreach($result as $row) {
                                    ?>
                                    <tr>
                                    <th scope="row"><?php echo $row["id_groupe"];  ?></th>
                                         <td><?php echo $row["nom_groupe"];  ?></td>
                                       
                                    </tr>
                                    <?php 
                                          }
                                        ?>
                                


                                </tbody>
                            </table>
                        </div>
                    </div>
</div>
<?php
    }else{
      echo "not authorized";
    }
    ?>