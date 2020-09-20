<?php
session_start();
include("../config/db.php");
if(isset($_SESSION["role"]) && $_SESSION["role"] == "admin"){



?>
<div class="container">
<br><br><br>
                        
                        <div class="table-responsive">
                            <table id="productsTable" class="table table-bordered" style="text-align:center">
                                <thead>
                                    <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Nom</th>
                                    <th scope="col">Prenom </th>
                                    <th scope="col">Sexe</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Faculté</th>
                                    <th scope="col">Département</th>
                                    <th scope="col">Date Naissance</th>
                                    <th scope="col">Pseudo</th>
                                    <th scope="col">Etat</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php 
                                    
                                    $pdo = Config::getPdo();
                                    $query = "SELECT * FROM users WHERE confirmed = ?";
                                    $sql = $pdo->prepare($query);
                                    $sql->execute([0]);
                                    $result = $sql->fetchAll(PDO::FETCH_ASSOC);
                                    foreach($result as $row) {
                                        //var_dump(base64_encode($row["imageProf"]));
                                ?>
                                    <tr>
                                    <th scope="row"><?php echo $row["id_utilisateur"] ?></th>
                                        <td><?php echo $row["nom"] ?></td>
                                        <td><?php echo $row["prenom"] ?></td>
                                        <td><?php echo $row["sexe"] ?></td>
                                        <td><?php echo $row["email"] ?></td>
                                        <td><?php echo $row["faculte"] ?> </td>
                                        <td><?php echo $row["departement"] ?> </td>
                                        <td><?php echo $row["date_naiss"] ?></td>

                                       <td>
                                        <?php echo $row["pseudo"] ?>
                                        </td>
                                       
                                        <td><a href="process/confirmer.php?id=<?php echo $row['id_utilisateur'] ?>"> <button class="btn btn-primary" >Confirmer</button></a></td>
                                    </tr>
                            
                                        <?php 
                                    }
                                        ?>

                                </tbody>
                            </table>
                        </div>
                    </div>
                    <?php
    }else{
      echo "not authorized";
    }
    ?>