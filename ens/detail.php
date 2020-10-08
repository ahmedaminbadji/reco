<?php 
session_start();
if(isset($_SESSION["role"]) && $_SESSION["role"] == "ens"){

if(isset($_GET["id"])){
    $id = $_GET["id"];
   
    include("../config/db.php");

    ?>
    <html>
        <head>
            <title>Teste</title>
            <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
            <link rel="stylesheet" href="../static/css/bootstrap.min.css">
            <script src="../static/js/jquery.js"></script>
            <script src="../static/js/bootstrap.min.js"></script>
        </head>
        <body>
            <div class="container">
                <h1>Questions : </h1>
                <br>
                <?php 
                
                $pdo = Config::getPdo();
                $query = "SELECT * FROM question WHERE  id_teste = ?";
                $sql = $pdo->prepare($query);
                $sql->execute([$id]);
                $result = $sql->fetchAll(PDO::FETCH_ASSOC);
                $i = 1 ;
                foreach($result as $row) {
                    
                    ?>
                    <h3>Question <?php echo $i; ?> : </h3>
                    <p><?php echo $row["question_text"] ?></p>
                    <ul class="list-group">
                        <?php 
                        $pdo = Config::getPdo();
                        $query = "SELECT * FROM reponse WHERE  id_question = ?";
                        $sql = $pdo->prepare($query);
                        $sql->execute([$row["id_question"]]);
                        $result = $sql->fetchAll(PDO::FETCH_ASSOC);
                        $j=0;
                        foreach($result as $row1) {
                        ?>
                        <li class="list-group-item">
                          <?php  echo $row1["reponse_text"] ?> &nbsp; &nbsp;
                          <a href="process/delReponse.php?id=<?php echo $row1["id_reponse"]  ?>" class="btn btn-danger">Supprimer</a>
                          
                        </li>
                        <?php 
            
            }
            ?>
                    </ul>
                    <br>
                    <button class="btn btn-primary showAddReponseModal" data-toggle="modal" data-target="#addReponseModal" data-id="<?php echo $row["id_question"]; ?>" >Ajouter Reponse</button>
                    <a href="process/delQuest.php?id=<?php echo $row["id_question"]  ?>" class="btn btn-danger">Supprimer Question</a>
                    <br><br>
                    <?php 
            $i++;    
            }
                    ?>
                    
            </div>





            <div class="modal fade" id="addReponseModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Ajouter une reponse </h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
        <form action="process/ajouterReponse.php" method="post">
                                                <div class="form-group">
                                             <input type="hidden" name="id" id="quest_id">
                                                </div>
                                                <div class="form-group">
                                                    <label for="reponse">Reponse : </label>
                                                    <input type="text" name="reponse" class="form-control" required>
                                                </div>
                                                <div class="form-group">
                                                    <select name="valeur" id="valeur" class="form-control" required>
                                                        <option value="1">Vrai</option>
                                                        <option value="0">Faux</option>
                                                    </select>
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
    $(".showAddReponseModal").click(function(){
    $("#quest_id").val($(this).attr('data-id'));
});
  </script>
        </body>
    </html>

    <?php 
}

?>
<?php
    }else{
      echo "not authorized";
    }
    ?>