<?php 
    include("../config/db.php");
?>
<div class="container">
<br>
<h3>Aprenants besoin d'aide</h3>
       <br><br>
<div class="table-responsive">
                                <table id="productsTable" class="table table-bordered" style="text-align:center">
                                    <thead>
                                        <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Aprenant</th>
                                        <th scope="col">Niveau</th>
                                        <th scope="col">Groupe</th>
                                        <th scope="col"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php 
                                          $pdo = Config::getPdo();
                                          $query = "SELECT * FROM aprenant WHERE besoin_aide = ?";
                                          $sql = $pdo->prepare($query);
                                          $sql->execute([1]);
                                          $result = $sql->fetchAll(PDO::FETCH_ASSOC);
                                          foreach($result as $row) {
                                    ?>
                                        <tr>

                                        <th scope="row"><?php echo $row["id_aprenant"] ?></th>
                                        
                                        <td><?php 
                                         $query = "SELECT * FROM users WHERE id_utilisateur = ?";
                                         $sql = $pdo->prepare($query);
                                         $sql->execute([$row["id_utilisateur"]]);
                                         $result = $sql->fetch(PDO::FETCH_ASSOC);
                                         
                                        echo $result["nom"] . " " . $result["prenom"] ;
                                        ?> </td>
                                        <td>
                                            <?php 
                                           
                                             echo $row["niveau"];
                                            ?>
                                        </td>
                                        <td> <?php 
                                         $query = "SELECT * FROM groupe WHERE id_groupe = ?";
                                         $sql = $pdo->prepare($query);
                                         $sql->execute([$row["groupe_id"]]);
                                         $result = $sql->fetch(PDO::FETCH_ASSOC);

                                         echo $result["nom_groupe"];
                                        ?></td>
                                        <td><a href="process/deleteModule.php?id=<?php echo $row["id_module"] ?>"><button class="btn btn-info" >Contacter</button></a></td>
                                        </tr>
                                        <?php 
                                          }
                                        ?>


                                    </tbody>
                                </table>
                            </div>
</div>