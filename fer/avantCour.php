<?php 
session_start();
    if(isset($_GET["path"]) &&  $_GET["path"] != ""){
        $path = $_GET["path"];
    }else{
        $path = "";
    }
    if(isset($_GET["id"]) &&  $_GET["id"] != ""){
        $_SESSION["cour_actuel"] = $_GET["id"];
    }
    ?>
    <!DOCTYPE html>

<html>

<head>
    <title>Table with database</title>


</head>

<body>

<div>
    <video onplay="onPlay(this)" id="inputVideo" autoplay muted></video>
</div>
<div>
    <h3 id="facialemotion"></h3>
</div>
<form action="../aprenant/process/avantCour.php" method="post">
    <input type="hidden" name="etat" id="etat">
    <input type="hidden" name="path" id="path" value="<?php echo  $path; ?>">
    <button>Poursuiver</button>
</form>

    <script>
    var faceEmotion = "";
    var voiceEmotion = "";
    </script>
    <script type="text/javascript" src="js/jquery-2.1.1.min.js"></script>
    <script src="js/face-api.min.js"></script>
    <script src="js/tf.min.js"></script>
    <script src="js/commons.js"></script>
    <script src="js/fer.js"></script>
    <script>
        run();
    </script>
</body>

</html>