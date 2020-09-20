<?php  session_start();
include("../config/db.php");
if(isset($_SESSION["role"]) && $_SESSION["role"] == "admin"){



?>
<ul class="nav nav-tabs" role="tablist">
    <li class="nav-item nav-link active" ><a role="tab" aria-controls="ajoutDoc" aria-selected="true" data-toggle="tab"  href="#ajoutDoc">Ajouter un tuteur </a></li>
    <li><a data-toggle="tab" class="nav-item nav-link"  href="#listeDoc">Liste des tuteurs  </a></li>
    </ul>
    <div class="tab-content">
                    <div id="ajoutDoc" class="tab-pane fade show active">
                        <form action="process/ajouterTuteur.php" method="post" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-md-6">
                                    <input type="text" name="inputName" class="form-control" placeholder="Nom" autofocus required>
                                </div>
                                <div class="col-md-6">
                                    <input type="text" name="inputFname" class="form-control" placeholder="Prénom" autofocus required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <select name="sexe" id="sexe" class="form-control" required>
                                        <option value="homme">Homme</option>
                                        <option value="femme">Femme</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <input type="email" name="inputEmail" class="form-control" placeholder="Email" autofocus required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <select name="inputFac" id="fac" class="form-control" required>
                                        <option value="mism">MISM</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <select name="inputDep" id="departement" class="form-control" required>
                                        <option value="informatique">Informatique</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <input type="date" name="inputDateN" class="form-control" id="dateN" autofocus required>
                                </div>
                                
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <input type="text" name="pseudo" class="form-control" placeholder="Pseudo" autofocus required>
                                </div>
                                <div class="col-md-6">
                                    <input type="password" name="pass" class="form-control" placeholder="Mot de passe" autofocus required>
                                </div>
                            </div>
                            
                               <br><br>
                                <center>
                                    <button class="btn btn-primary" style="width:30%;">Ajouter</button>
                                </center>
                            
                        </form>
                    </div>
                    <div id="listeDoc" class="tab-pane fade">
                    <br><br><br>
                        <div class="container">
                            
                            <div class="table-responsive">
                                <table id="productsTable" class="table table-bordered" style="text-align:center">
                                    <thead>
                                        <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Nom</th>
                                        <th scope="col">Prénom </th>
                                        <th scope="col">Sexe</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Faculté</th>
                                        <th scope="col">Département</th>
                                        <th scope="col">Date de naissance</th>
                                        <th scope="col">Pseudo</th>
                                        <th scope="col">Image</th>
                                        <th scope="col"></th>
                                        <th scope="col"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php 
                                          $pdo = Config::getPdo();
                                          $query = "SELECT * FROM users WHERE type = ?";
                                          $sql = $pdo->prepare($query);
                                          $sql->execute(["tuteur"]);
                                          $result = $sql->fetchAll(PDO::FETCH_ASSOC);
                                          foreach($result as $row) {
                                    ?>
                                        <tr>
                                        <th scope="row"><?php echo $row["id_utilisateur"] ?></th>
                                        
                                        <td><?php echo $row["nom"] ?> </td>
                                        <td><?php echo $row["prenom"] ?> </td>
                                        <td><?php echo $row["sexe"] ?> </td>
                                        <td><?php echo $row["email"] ?> </td>
                                        <td><?php echo $row["faculte"] ?> </td>
                                        <td><?php echo $row["departement"] ?></td>
                                        <td><?php echo $row["date_naiss"] ?> </td>
                                        <td><?php echo $row["pseudo"] ?> </td>
                                        <td><button class="btn btn-info" id="modifierTuteur" data-toggle="modal" data-id="<?php  echo $row["id_utilisateur"] ?>" data-target="#modifierModal">Modifier</button></td>
                                        
                                        <td><a href="process/deleteTuteur.php?id=<?php echo $row["id_utilisateur"] ?>"><button class="btn btn-danger">Supprimer</button></a></td>
                                        
                                        <td></td>
                                        </tr>
                                        <?php 
                                          }
                                        ?>


                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
    </div>
    <div class="modal fade" id="modifierModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modifier Tuteur </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form action="process/modifierTuteur.php" method="post" enctype="multipart/form-data">
                            <input type="hidden" name="id" id="id">
                            <div class="row">
                                <div class="col-md-6">
                                    <input type="text" name="inputName" class="form-control" placeholder="Nom" autofocus >
                                </div>
                                <div class="col-md-6">
                                    <input type="text" name="inputFname" class="form-control" placeholder="Prénom" autofocus >
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <select name="sexe" id="sexe" class="form-control" >
                                        <option value="homme">Homme</option>
                                        <option value="femme">Femme</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <input type="email" name="inputEmail" class="form-control" placeholder="Email" autofocus >
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <select name="inputFac" id="fac" class="form-control" >
                                        <option value="mism">MISM</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <select name="inputDep" id="departement" class="form-control" >
                                        <option value="informatique">Informatique</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <input type="date" name="inputDateN" class="form-control" id="dateN" autofocus >
                                </div>
                                
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <input type="text" name="pseudo" class="form-control" placeholder="Pseudo" autofocus >
                                </div>
                                <div class="col-md-6">
                                    <input type="password" name="pass" class="form-control" placeholder="Mot de passe" autofocus >
                                </div>
                            </div>
                            
                              <br><br>
                                <center>
                                    <button class="btn btn-primary">Modifier</button>
                                </center>
                            
                        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<script>
    $("#modifierTuteur").click(function(){
        var id = $(this).data('id');
        $("#id").val(id);
    });
</script>
<?php
    }else{
      echo "not authorized";
    }
    ?>