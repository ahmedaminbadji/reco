<?php 
    include("../config/db.php");
?>
    <ul class="nav nav-tabs" role="tablist">
    <li class="nav-item nav-link active" ><a role="tab" aria-controls="ajoutTest" aria-selected="true" data-toggle="tab"  href="#ajoutTest">Ajouter un teste </a></li>
    <li><a data-toggle="tab" class="nav-item nav-link"  href="#listeTest">Liste des testes</a></li>
    <li><a data-toggle="tab" class="nav-item nav-link"  href="#resultTest">Résultats des testes</a></li>
    </ul>
<div class="tab-content">
                    <div id="ajoutTest" class="tab-pane fade show active">
                        <div class="offset-md-3 col-md-6">
                            <form action="process/addTest.php" method="post">
                                <div class="form-group">
                                    <h5>Type de test</h5>
                                    <select name="typeTeste" id="typeTeste" class="form-control" required>
                                        <option value="Micro Intero">Micro interogation</option>
                                        <option value="Examen">Examen</option>
                                        <option value="Examen TP">Examen TP</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                <h5>Module</h5>
                                                    <select name="module" id="module" class="form-control" required>
                                                    <?php 
                                                        $pdo = Config::getPdo();
                                                        $query = "SELECT * FROM module WHERE ?";
                                                        $sql = $pdo->prepare($query);
                                                        $sql->execute([1]);
                                                        $result = $sql->fetchAll(PDO::FETCH_ASSOC);
                                                        var_dump($result);
                                                        foreach($result as $row) {
                                                    ?>
                                                        <option value="<?php echo $row["id_module"] ?>"><?php echo $row["nom_module"] ?> </option>
                                                        <?php 
                                          }
                                        ?>
                                                    </select>
                                </div>
                             
                                <br>
                                <center>
                                    <button class="btn btn-primary" style="width:50%;">Ajouter</button>
                                </center>
                            </form>
                        </div>
                    </div>
                    <div id="listeTest" class="tab-pane fade">
                    <div class="container">
                        
                        <div class="table-responsive">
                            <table id="productsTable" class="table table-bordered" style="text-align:center">
                                <thead>
                                    <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Type</th>
                                    <th scope="col" >Module</th>
                                    <th scope="col">Détail</th>
                                    <th scope="col"></th>
                                    <th scope="col"></th>
                                    <th scope="col"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php 
                                          $pdo = Config::getPdo();
                                          $query = "SELECT * FROM teste WHERE  ?";
                                          $sql = $pdo->prepare($query);
                                          $sql->execute([1]);
                                          $result = $sql->fetchAll(PDO::FETCH_ASSOC);
                                          foreach($result as $row) {
                                    ?>
                                    <tr>
                                    <th scope="row"> <?php echo $row["id_teste"]; ?> </th>
                                        <td> <?php echo $row["type_teste"]; ?></td>
                                        <td>
                                        <?php 
                                          $pdo = Config::getPdo();
                                          $query = "SELECT * FROM module WHERE  id_module = ?";
                                          $sql = $pdo->prepare($query);
                                          $sql->execute([$row["module"]]);
                                          $result = $sql->fetch(PDO::FETCH_ASSOC);
                                          echo $result["nom_module"];
                                    ?>
                                        </td>
                                    <td> <a href="detail.php?id=<?php echo $row["id_teste"]; ?>" class="btn btn-primary">Détail </a></td>
                                        <td>
                                            <button class="btn btn-info showAddQuestModal" data-toggle="modal" data-target="#addQuestModal" data-id="<?php echo $row["id_teste"]; ?>" >Ajouter Question</button>
                                        </td>
                                    <td>
                                        <center>
                                        <button class="btn btn-primary showEditTestModal" data-toggle="modal" data-target="#editTestModal" data-id="<?php echo $row["id_teste"]; ?>"> Modifier Teste </button></td>
                                    </center>
                                        <td>
                                            <center>
                                        <a href="process/supprimerTeste.php?id=<?php echo $row["id_teste"]; ?>" class="btn btn-danger text-white">
                                            Supprimer</a>
                                        </center>
                                        </td>
                                    </tr>
                                    <?php 
                                          }
                                        ?>


                                </tbody>
                            </table>
                        </div>
                    </div>
                    </div>
                    <div id="resultTest" class="tab-pane fade">
                    <div class="container">
                        
                        <div class="table-responsive">
                            <table id="productsTable" class="table table-bordered" style="text-align:center">
                                <thead>
                                    <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Aprenant</th>
                                    <th scope="col">Test</th>
                                    <th scope="col">Note</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php 
                                          $pdo = Config::getPdo();
                                          $query = "SELECT * FROM resultat WHERE  ?";
                                          $sql = $pdo->prepare($query);
                                          $sql->execute([1]);
                                          $result = $sql->fetchAll(PDO::FETCH_ASSOC);
                                          foreach($result as $row) {
                                    ?>
                                    <tr>
                                    <th scope="row"> <?php echo $row["id"] ?> </th>
                                        <td> <?php 
                                        $id_app = $row["aprenant"];

                                      
                                        $query = "SELECT * FROM users WHERE id_utilisateur = (SELECT `id_utilisateur` FROM `aprenant` WHERE `id_aprenant`=?)";
                                        $sql = $pdo->prepare($query);
                                        $sql->execute([$id_app]);
                                        $result = $sql->fetch(PDO::FETCH_ASSOC);
                                        echo $result["nom"]. " ".$result["prenom"];
                                        ?> </td>
                                        <td> <button class="btn btn-info">Détail</button> </td>
                                        <td> <?php echo $row["note"]; ?> </td>
                                    
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


<div class="modal fade" id="addQuestModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Ajouter une question </h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
        <form action="process/ajouterQuest.php" method="post">
                                                <div class="form-group">
                                             <input type="hidden" name="id" id="test_id">
                                                </div>
                                                <div class="form-group">
                                                    <label for="quest">Question : </label>
                                                    <input type="text" name="questText" class="form-control" required>
                                                </div>
                                                <br>
                                                <center>
                                                <button class="btn btn-primary" style="width:50%;">Ajouter</button>
                                                </center>
                                            </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>



  <div class="modal fade" id="editTestModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Modifier Teste </h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
        <form action="process/modifierTest.php" method="post">
                                <div class="form-group">
                                <input type="hidden" name="id" id="test_idE">
                                    <h5>Type de test</h5>
                                    <select name="typeTeste" id="typeTeste" class="form-control" required>
                                        <option value="Micro Intero">Micro interogation</option>
                                        <option value="Examen">Examen</option>
                                        <option value="Examen TP">Examen TP</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                <h5>Module</h5>
                                                    <select name="module" id="module" class="form-control" required>
                                                    <?php 
                                                        $pdo = Config::getPdo();
                                                        $query = "SELECT * FROM module WHERE ?";
                                                        $sql = $pdo->prepare($query);
                                                        $sql->execute([1]);
                                                        $result = $sql->fetchAll(PDO::FETCH_ASSOC);
                                                        var_dump($result);
                                                        foreach($result as $row) {
                                                    ?>
                                                        <option value="<?php echo $row["id_module"] ?>"><?php echo $row["nom_module"] ?> </option>
                                                        <?php 
                                          }
                                        ?>
                                                    </select>
                                </div>
                             
                                <br>
                                <center>
                                    <button class="btn btn-primary" style="width:50%;">Modifier</button>
                                </center>
                            </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
<script>
$(".showAddQuestModal").click(function(){
    $("#test_id").val($(this).attr('data-id'));
});

$(".showEditTestModal").click(function(){
    $("#test_idE").val($(this).attr('data-id'));
});
</script>
