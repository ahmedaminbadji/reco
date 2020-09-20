
<?php session_start();
include("../config/db.php");
if(isset($_SESSION["role"]) && $_SESSION["role"] == "admin"){



?>
<ul class="nav nav-tabs" role="tablist">
    <li class="nav-item nav-link active" ><a role="tab" aria-controls="ajoutDoc" aria-selected="true" data-toggle="tab"  href="#ajoutDoc">Ajouter un module </a></li>
    <li><a data-toggle="tab" class="nav-item nav-link"  href="#listeDoc">Liste des modules  </a></li>
    </ul>
    <div class="tab-content">
                    <div id="ajoutDoc" class="tab-pane fade show active">
                        <form action="process/ajouterModule.php" method="post" enctype="multipart/form-data">
                           <div class="offset-md-4 col-md-4">
                                <div class="form-groupe">
                                    <input type="text" name="nomModule" class="form-control" placeholder="Nom module" autofocus required>
                                </div>
                                <br>
                                <div class="form-group">
                                          <select name="specialite" id="specialite" class="form-control" required>
                                          <?php 
                                            $pdo = Config::getPdo();
                                            $query = "SELECT * FROM specialite WHERE ?";
                                            $sql = $pdo->prepare($query);
                                            $sql->execute([1]);
                                            $result = $sql->fetchAll(PDO::FETCH_ASSOC);
                                            foreach($result as $row) {
                                          ?>
                                          <option value="<?php echo $row["id_specialite"] ?>"><?php echo $row["nom_specialite"] ?></option>
                                          <?php 
                                          }
                                        ?>
                                          </select>
                                </div>
                                </div>
                 
                                <center>
                                    <button class="btn btn-primary" style="width:30%">Ajouter</button>
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
                                        <th scope="col">Nom module</th>
                                        <th scope="col">Nom Specialité</th>
                                        <th scope="col"></th>
                                        <th scope="col"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php 
                                          $pdo = Config::getPdo();
                                          $query = "SELECT * FROM module WHERE ?";
                                          $sql = $pdo->prepare($query);
                                          $sql->execute([1]);
                                          $result = $sql->fetchAll(PDO::FETCH_ASSOC);
                                          foreach($result as $row) {
                                    ?>
                                        <tr>

                                        <th scope="row"><?php echo $row["id_module"] ?></th>
                                        
                                        <td><?php echo $row["nom_module"] ?> </td>
                                        <td>
                                            <?php 
                                             
                                             $query2 = "SELECT * FROM specialite WHERE id_specialite = ?";
                                             $sql2 = $pdo->prepare($query2);
                                             $sql2->execute([$row['id_specialite']]);
                                             $result2 = $sql2->fetch(PDO::FETCH_ASSOC);
                                             echo $result2["nom_specialite"];
                                            ?>
                                        </td>
                                        <td><button class="btn btn-info modifierModule"  data-toggle="modal" data-id="<?php  echo $row["id_module"] ?>" data-target="#modifierModal">Modifier</button></td>
                                        <td><a href="process/deleteModule.php?id=<?php echo $row["id_module"] ?>"><button class="btn btn-danger" >Supprimer</button></a></td>
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
    <!-- Modal -->
    <div class="modal fade" id="modifierModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modifier Specialité </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form action="process/modifierModule.php" method="post" enctype="multipart/form-data">
                           <div class="offset-md-4 col-md-4">
                               <input type="hidden" name="id" id="idM">
                                <div class="form-groupe">
                                    <input type="text" name="nomModule" class="form-control" placeholder="Nom module" autofocus required>
                                </div>
                                <br>
                                <div class="form-group">
                                          <select name="specialite" id="specialite" class="form-control" required>
                                          <?php 
                                            $pdo = Config::getPdo();
                                            $query = "SELECT * FROM specialite WHERE ?";
                                            $sql = $pdo->prepare($query);
                                            $sql->execute([1]);
                                            $result = $sql->fetchAll(PDO::FETCH_ASSOC);
                                            foreach($result as $row) {
                                          ?>
                                          <option value="<?php echo $row["id_specialite"] ?>"><?php echo $row["nom_specialite"] ?></option>
                                          <?php 
                                          }
                                        ?>
                                          </select>
                                </div>
                                </div>
                 
                                <center>
                                    <button class="btn btn-primary" style="width:30%">Modifier</button>
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
    $(".modifierModule").click(function(){
        var id = $(this).data('id');
        $("#idM").val(id);
    });
</script>
<?php
    }else{
      echo "not authorized";
    }
    ?>