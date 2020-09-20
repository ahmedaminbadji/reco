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
        <script src="static/js/jquery.js"></script>
        <script src="static/ViewerJS/pdf.js"></script>
    </head>
<body>
       
        <iframe id="myiframe" src = "" width='90%' height='750' allowfullscreen webkitallowfullscreen></iframe> 
        <input type="hidden" name="path" id="path" value="<?php echo $path; ?>">
            <button id="completer" >completer</button>
        
       
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
            $('#myiframe').attr('src', 'upload/'+path);
     

$("#completer").click(function(){
    //si on a passé le 50% du doc alors direction detection visage
    window.location.href = "fer/apresCour.php";
    //sinon index des cours
});
        </script>
        <script src="static/js/app.js"></script>
    </body>
    </html>