<!DOCTYPE html><html lang="en">
    <?php 
    session_start();
      function count_pages($pdfname) {
        $pdftext = file_get_contents($pdfname);
        $num = preg_match_all("/\/Page\W/", $pdftext, $dummy);
        return $num;
      }
    if(isset($_GET["path"]) &&  $_GET["path"] != ""){
        $path = $_GET["path"];
        $path2 = "http://localhost/reco/upload/".$path;
        $page_number =  count_pages($path2);
        $_SESSION["cour_actuel"] = $_GET["id"];
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
            <div class="col-md-10">
            <iframe id="myiframe" src = "" width='100%' height='750' allowfullscreen webkitallowfullscreen></iframe> 
        <input type="hidden" name="path" id="path" value="<?php echo $path; ?>">

        <input type="hidden" name="pageNb" id="pageNb" value="<?php echo $page_number; ?>">
      
            </div>
            <div class="col-md-2">
            <button class="btn btn-primary" id="completer" >completer</button>
            </div>
           

        </div>
       </div>
      
  
            <script>
    var faceEmotion = "";
    var voiceEmotion = "";
    </script>
    <script type="text/javascript" src="js/jquery-2.1.1.min.js"></script>

       
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
         
       
var begin;
        var end;
            var path = $("#path").val();
            $('#myiframe').attr('src', '../upload/'+path);
     
$(document).ready(function(){
    begin = Date.now();
});
$("#completer").click(function(){
    //si on a passé le 50% du doc alors direction detection visage
    end = Date.now();
    timeIs = end - begin;
    var pageNb = $("#pageNb").val();
    window.location.href = "apresHorsCour.php?t="+timeIs+"&pagenb="+pageNb;
    //sinon index des cours
});
        </script>
        <script src="static/js/app.js"></script>
    </body>
    </html>