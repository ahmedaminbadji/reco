<!DOCTYPE html><html lang="en">
    <?php 
    if(isset($_GET["path"]) &&  $_GET["path"] != ""){
        $path = $_GET["path"];
    }else{
        $path = "";
    }
    ?>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
        <link rel="stylesheet" href="../static/css/bootstrap.min.css">
        <script src="../static/js/jquery.js"></script>
        <script src="../static/ViewerJS/pdf.js"></script>
    </head>
<body>
       <div class="container-fluid">
        <div class="row">
            <div class="col-md-6">
            <iframe id="myiframe" src = "" width='100%' height='750' allowfullscreen webkitallowfullscreen></iframe> 
        <input type="hidden" name="path" id="path" value="<?php echo $path; ?>">
      
            </div>
            <div class="col-md-6">
            <div>
            <video onplay="onPlay(this)" id="inputVideo" autoplay muted></video>
</div>
<div>
    <h3 id="facialemotion"></h3>
</div>
            <button id="completer" >completer</button>
            </div>
           

        </div>
       </div>
      
  
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
       
        <script>
//         $(window).on('load',function(){
         
//             ms = 5000;
//             var start = new Date().getTime();
//    var end = start;
//    while(end < start + ms) {
//      end = new Date().getTime();
//   }
//             nbPages = $("#pageNumber").attr("max");
//         window.alert(nbPages);

//         });
         
       
       
            var path = $("#path").val();
            $('#myiframe').attr('src', '../upload/'+path);
     

$("#completer").click(function(){
    //si on a passé le 50% du doc alors direction detection visage
    window.location.href = "fer/apresCour.php";
    //sinon index des cours
});
        </script>
        <script src="static/js/app.js"></script>
    </body>
    </html>