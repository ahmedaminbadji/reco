<?php 
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
                    <form action="process/passTest.php" method="post">
                    <input type="hidden" name="id" value="<?php echo $id; ?>">
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
                        <div class="form-group">
                            <input type="checkbox" value="<?php  echo $row1["valeur"] ?>" name="qst<?php echo $i; ?>" class="form-control">
                        </div>
                          <?php  echo $row1["reponse_text"] ?> &nbsp; &nbsp;
                        </li>
                        <?php 
            
            }
            ?>
                    </ul>
                    <br><br>
                    <?php 
            $i++;    
            }
                    ?>
                    <center>
                        <button class="btn btn-primary">Terminer</button>
                    </center>
            </form>
            </div>




        </body>
    </html>

    <?php 
}

?>