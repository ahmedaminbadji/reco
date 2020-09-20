<?php 
   session_start();
   include("../config/db.php");
   if(isset($_SESSION["role"]) && $_SESSION["role"] == "admin"){
   
   
?>
<ul class="nav nav-tabs" role="tablist">
    <li class="nav-item nav-link active" ><a role="tab" aria-controls="ajoutDoc" aria-selected="true" data-toggle="tab"  href="#ajoutDoc">Ajouter une specialité </a></li>
    <li><a data-toggle="tab" class="nav-item nav-link"  href="#listeDoc">Liste des specialité  </a></li>
    </ul>
    <div class="tab-content">
                    <div id="ajoutDoc" class="tab-pane fade show active">
                        <form action="process/ajouterSpec.php" method="post" enctype="multipart/form-data">
                           
                                <div class="offset-md-4 col-md-4">
                                    <input type="text" name="nomSpecialite" class="form-control" placeholder="Nom specialité" autofocus required>
                                </div>
                    <br>
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
                                        <th scope="col">Nom Specialité</th>
                                        <th scope="col"></th>
                                        <th scope="col"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php 
                                          $pdo = Config::getPdo();
                                          $query = "SELECT * FROM specialite WHERE ?";
                                          $sql = $pdo->prepare($query);
                                          $sql->execute([1]);
                                          $result = $sql->fetchAll(PDO::FETCH_ASSOC);
                                          foreach($result as $row) {
                                    ?>
                                        <tr>
                                        <th scope="row"><?php echo $row["id_specialite"] ?></th>
                                        
                                        <td><?php echo $row["nom_specialite"] ?> </td>
                                        
                                        <td><button class="btn btn-info modifierSpc"  data-toggle="modal" data-id="<?php  echo $row["id_specialite"] ?>" data-target="#modifierModal">Modifier</button></td>
                                        <td><a href="process/deleteSpec.php?id=<?php echo $row["id_specialite"] ?>"><button class="btn btn-danger" >Supprimer</button></a></td>
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
      <form action="process/modifierSpc.php" method="post" >
                           
                    <input type="hidden" name="id" id="idS" value="">
                                    <input type="text" name="nomSpecialite" class="form-control" placeholder="Nom specialité" autofocus required>
                                
                    <br>
                                <center>
                                    <button type="submit" class="btn btn-primary" style="width:30%">Modifier</button>
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
    $(".modifierSpc").click(function(){
        var id = $(this).data('id');
        $("#idS").val(id);
    });
</script>
<?php
    }else{
      echo "not authorized";
    }
    ?>
