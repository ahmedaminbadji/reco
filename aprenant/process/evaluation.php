<?php 
require_once("../../config/db.php");
session_start();
$etat = $_POST["etat"];
$pdo = Config::getPdo();
                $query = "UPDATE `aprenant` SET `last_emotion`=? WHERE `id_utilisateur`=?";
                $sql = $pdo->prepare($query);
                $sql->execute([$etat,$_SESSION["id_user"]]);


         
?>
<html>
    <head>
    <title>Evaluation</title>
<link href="https://netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="../../static/css/star-rating.css">
    <script src="../../static/js/jquery.js"></script>

    <script src="../../static/js/star-rating.js"></script>
    </head>
    <body>
    <div class="container">
    <br><br>
    <form action="apresHorsCour.php" method="POST">
    <label for="input-1" class="control-label">Evaluation du document</label>
<input type="hidden" name="etat" id="etat" value="<?php echo $etat; ?>">
<input id="rating-system" name="rating" type="number" class="rating" min="1" max="5" step="1">
<br>
<br>
<center>
    <button class="btn btn-primary">Evaluer</button>
</center>
</form>
</div>
    </body>
</html>