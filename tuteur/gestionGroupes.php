
<?php 
    include("../config/db.php");
    session_start();
    if(isset($_SESSION["role"]) && $_SESSION["role"] == "tuteur"){

?>
<ul class="nav nav-tabs" role="tablist">
    <li class="nav-item nav-link active" ><a role="tab" aria-controls="ajoutDoc" aria-selected="true" data-toggle="tab"  href="#ajoutDoc">Creer un groupe </a></li>
    <li><a data-toggle="tab" class="nav-item nav-link"  href="#listeDoc">Demande d'adheison au groupes    </a></li>
    <li><a data-toggle="tab" class="nav-item nav-link"  href="#listeGroupes">Liste des  groupes    </a></li>
        
</ul>
    <div class="tab-content">
                    <div id="ajoutDoc" class="tab-pane fade show active">
                    <br><br>
                    <div class="container">
                        <form action="process/creeGroupe.php" method="post">
                            <input type="text" name="nomGroupe" placeholder="Nom de groupe" required>
                            <button class="btn btn-primary">Creer</button>
                        </form>
                        </div>
                    </div>
                    <div id="listeDoc" class="tab-pane fade">
                              
                        <div class="table-responsive">
                                <table id="productsTable" class="table table-bordered" style="text-align:center">
                                    <thead>
                                        <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Aprenant</th>
                                        <th scope="col">Groupe</th>
                                        <th scope="col"></th>
                                        <th scope="col"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php 
                                          $pdo = Config::getPdo();
                                          $query = "SELECT * FROM demande_groupe WHERE id_groupe  IN (SELECT id_groupe FROM groupe WHERE tuteur = ?)";
                                          $sql = $pdo->prepare($query);
                                          $sql->execute([$_SESSION["id_user"]]);
                                          $result = $sql->fetchAll(PDO::FETCH_ASSOC);
                                          foreach($result as $row) {
                                    ?>
                                        <tr>

                                        <th scope="row"><?php echo $row["id_demande"] ?></th>
                                    <td><?php 
                                      $query = "SELECT * FROM users WHERE id_utilisateur = ?";
                                      $sql = $pdo->prepare($query);
                                      $sql->execute([$row["id_utilisateur"] ]);
                                      $result = $sql->fetch(PDO::FETCH_ASSOC);
                                         echo $result["nom"] . " ".$result["prenom"];
                                    ?></td>
                                    <td>
                                    <?php 
                                      $query = "SELECT * FROM groupe WHERE id_groupe = ?";
                                      $sql = $pdo->prepare($query);
                                      $sql->execute([$row["id_groupe"] ]);
                                      $result = $sql->fetch(PDO::FETCH_ASSOC);
                                         echo $result["nom_groupe"] ;
                                    ?>
                                    </td>
                                    <td> <a href="process/approuverDemande.php?id=<?php echo $row["id_demande"] ?>"> <button class="btn btn-info" >Confirmer</button></a> </td>
                                    <td> <a href="process/annulerDemande.php?id=<?php echo $row["id_demande"] ?>"> <button class="btn btn-danger">Annuler</button> </a> </td>
                                    </tr>
                                        <?php 
                                          }
                                        ?>
                                    </tbody>
                                    </table>
                        </div>
                    </div>
                    <div id="listeGroupes" class="tab-pane fade">
                    <div class="table-responsive">
                                <table id="productsTable" class="table table-bordered" style="text-align:center">
                                    <thead>
                                        <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Nom Groupe</th>
                                        <th scope="col"></th>
                                        <th scope="col"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php 
                                          $pdo = Config::getPdo();
                                          $query = "SELECT * FROM groupe WHERE ?";
                                          $sql = $pdo->prepare($query);
                                          $sql->execute([1]);
                                          $result = $sql->fetchAll(PDO::FETCH_ASSOC);
                                          foreach($result as $row) {
                                    ?>
                                        <tr>

                                        <th scope="row"><?php echo $row["id_groupe"] ?></th>
                                    <td><?php 
                                    
                                         echo $row["nom_groupe"] ;
                                    ?></td>
                                   
                                    <td>  <button class="btn btn-info modifierGroupe" data-toggle="modal" data-id="<?php  echo $row["id_groupe"] ?>" data-target="#modifierModal" >Modifier</button> </td>
                                    <td> <a href="process/delGroupe.php?id=<?php echo $row["id_groupe"] ?>"> <button class="btn btn-danger">Supprimer</button> </a> </td>
                                   </tr>
                                        <?php 
                                          }
                                        ?>
                                    </tbody>
                                    </table>
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
      <form action="process/modifierGroupe.php" method="post">
      <input type="hidden" name="id" id="idG">
                            <input type="text" name="nomGroupe" placeholder="Nom de groupe" required>
                            <button class="btn btn-primary">Modifier</button>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<script>
    $(".modifierGroupe").click(function(){
        var id = $(this).data('id');
        $("#idG").val(id);
    });
</script>
<?php
    }else{
      echo "not authorized";
    }
    ?>
