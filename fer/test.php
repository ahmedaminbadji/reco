<!DOCTYPE html>

<html>

<head>
    <title>Table with database</title>
    <link rel="stylesheet" href="../static/css/bootstrap.min.css">

</head>

<body>

<div>
    <video onplay="onPlay(this)" id="inputVideo" autoplay muted></video>
</div>
<div>
    <h3 id="facialemotion"></h3>
</div>
<form action="../aprenant/process/emotionState.php" method="post">
    <input type="hidden" name="etat" id="etat">
    <button class="btn btn-primary">Poursuiver</button>
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