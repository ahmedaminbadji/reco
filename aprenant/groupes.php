<?php 
    include("../config/db.php");
    session_start();
    if(isset($_SESSION["role"]) && $_SESSION["role"] == "aprenant"){

?>
<div class="container">
<div class="container">
                        <?php 
                        if($_SESSION["groupe"]=="none"){
                        }else{
                            echo "vous avez un groupe";
                        }
                            
                        ?>
                        <div class="table-responsive">
                            <table id="productsTable" class="table table-bordered" style="text-align:center">
                                <thead>
                                    <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Nom Groupe</th>
                                    <th scope="col">Action</th>
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
                                       <td><a href="process/demandeGroupe.php?id=<?php echo $row["id_groupe"]; ?>"><button class="btn btn-primary">Demande Groupe</button></a> </td>
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
