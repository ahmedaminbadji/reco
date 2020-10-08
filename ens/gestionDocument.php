
<?php 
    include("../config/db.php");
    session_start();
    if(isset($_SESSION["role"]) && $_SESSION["role"] == "ens"){

?>
<ul class="nav nav-tabs" role="tablist">
    <li class="nav-item nav-link active" ><a role="tab" aria-controls="ajoutDoc" aria-selected="true" data-toggle="tab"  href="#ajoutDoc">Ajouter un document </a></li>
    <li><a data-toggle="tab" class="nav-item nav-link"  href="#listeDoc">Liste des documents</a></li>
    </ul>
<div class="tab-content">
                    <div id="ajoutDoc" class="tab-pane fade show active">
                        <div class="container">
                        <div class="row">
                        <div class="col-md-3">
                        <ul class="nav flex-column" role="tablist"> 
                            <li class="nav-item nav-link active" >
                                <a role="tab" aria-controls="docCours" aria-selected="true" data-toggle="tab"  href="#docCours">Document de cours</a>
                            </li>
                            <li class="nav-item">
                                <a data-toggle="tab" class="nav-item nav-link"  href="#docHorsCours">Document hors cours</a>
                            </li>
                        </ul>
                        </div>
                                <div class=" col-md-6">
                                    <div class="tab-content">
                                        <div id="docCours" class="tab-pane fade show active">
                                            <form action="process/ajouterDoc.php" method="post" enctype="multipart/form-data">
                                                <div class="form-group">
                                                    <h5>Document de cours : (exercice, corrige exercice doc principale ou doc supplementaire)</h5>
                                                    <select name="typeCours" id="typeCOurs" class="form-control" required>
                                                        <option value="docPrincipale">Document principale</option>
                                                        <option value="exercice">Exercice</option>
                                                        <option value="corrigerExercice">Corrigé exercice</option>
                                                    </select>
                                                    <h5>Module</h5>
                                                    <select name="module" id="module" class="form-control" required>
                                                    <?php 
                                                        $pdo = Config::getPdo();
                                                        $query = "SELECT * FROM module WHERE ?";
                                                        $sql = $pdo->prepare($query);
                                                        $sql->execute([1]);
                                                        $result = $sql->fetchAll(PDO::FETCH_ASSOC);
                                                        foreach($result as $row) {
                                                    ?>
                                                        <option value="<?php echo $row["id_module"] ?>"><?php echo $row["nom_module"] ?> </option>
                                                        <?php 
                                          }
                                        ?>
                                                    </select>


                                                </div>
                                                <div class="form-group">
                                                    <input type="file" name="file[]" id="doc" required>
                                                </div>
                                                <br>
                                                <center>
                                                <button class="btn btn-primary" style="width:50%;">Ajouter</button>
                                                </center>
                                            </form>
                                        </div>
                                        <div id="docHorsCours" class="tab-pane fade">
                                            <form action="process/ajouterDocHors.php" method="post" enctype="multipart/form-data">
                                                    <div class="form-group">
                                                        <h5>Document hors cours : (livre, tuto)</h5>
                                                        <select name="typeCours" id="typeCours" class="form-control" required>
                                                            <option value="livre">Livre</option>
                                                            <option value="tuto">Tutoriel</option>
                                                        </select>
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
                                                    <div class="form-group">
                                                        <input type="file" name="file[]" id="doc" required>
                                                    </div>
                                                    <br>
                                                    <center>
                                                    <button class="btn btn-primary" style="width:50%;">Ajouter</button>
                                                    </center>
                                                </form>
                                        </div>
                                </div>
                            </div>
                            </div>
                        </div>
                    </div>
                    <div id="listeDoc" class="tab-pane fade">
                        <div class="container">
                        
                            <div class="table-responsive">
                                <table id="productsTable" class="table table-bordered" style="text-align:center">
                                    <thead>
                                        <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Document</th>
                                        <th scope="col">Module </th>
                                        <th scope="col">Type</th>
                                        <th scope="col"></th>
                                        <th scope="col"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php 
                                          $pdo = Config::getPdo();
                                          $query = "SELECT * FROM document WHERE  ?";
                                          $sql = $pdo->prepare($query);
                                          $sql->execute([1]);
                                          $result = $sql->fetchAll(PDO::FETCH_ASSOC);
                                          foreach($result as $row) {
                                    ?>
                                        <tr>
                                        <th scope="row"><?php echo $row["id_document"];  ?></th>
                                        <td> <a href="../pdf.php?path=<?php echo $row["emplacement"] ?>"> <button class="btn btn-info">Document</button> </a></td>
                                        <td>
                                        <?php 
                                          $pdo = Config::getPdo();
                                          $query = "SELECT * FROM module WHERE  id_module = ?";
                                          $sql = $pdo->prepare($query);
                                          $sql->execute([$row["id_module"]]);
                                          $result = $sql->fetch(PDO::FETCH_ASSOC);
                                          echo $result["nom_module"];
                                    ?>
                                        </td>
                                            <td><?php echo $row["type_document"];  ?></td>
                                            
                                          
                                           
                                       
                                        <td>
                                            <center>
                                            <button class="btn btn-primary ajouterDocModal" data-toggle="modal" data-target="#ajouterDocM" data-id="<?php echo $row["id_document"];  ?>"> <i class="fas fa-plus-square"></i>Ajouter document supplémentaire </button></td>
                                        </center>
                                            <td>
                                                <center>
                                            <a href="process/delDoc.php?id=<?php echo $row["id_document"]; ?>" class="btn btn-danger text-white">
                                                <i class="far fa-trash-alt"></i>Supprimer</a>
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
</div>
 <!-- Modal -->

 <div class="modal fade" id="ajouterDocM" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Ajouter un Document supplémentaire </h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
        <form action="process/ajouterDocSup.php" method="post" enctype="multipart/form-data">
                                                <div class="form-group">
                                             <input type="hidden" name="id" id="doc_id">
                                                </div>
                                                <div class="form-group">
                                                    <input type="file" name="file[]" id="doc" required>
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
<script>
    $(".ajouterDocModal").click(function(){
        $("#doc_id").val($(this).attr('data-id'));
    });
   
</script>
<?php
    }else{
      echo "not authorized";
    }
    ?>