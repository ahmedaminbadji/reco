<!DOCTYPE html><html lang="en">
    <?php 
    function count_pages($pdfname) {
        $pdftext = file_get_contents($pdfname);
        $num = preg_match_all("/\/Page\W/", $pdftext, $dummy);
        return $num;
      }
    if(isset($_GET["path"]) &&  $_GET["path"] != ""){
        $path = $_GET["path"];
        $path2 = "http://localhost/reco/upload/".$path;
        $page_number =  count_pages($path2);
    }else{
        
        
      
    }
    ?>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
        <link rel="stylesheet" href="static/css/bootstrap.min.css">
        <script src="static/js/jquery.js"></script>
        <script src="static/ViewerJS/pdf.js"></script>
    </head>
<body>
       
        <iframe id="myiframe" src = "" width='85%' height='750' allowfullscreen webkitallowfullscreen></iframe> 
        <input type="hidden" name="path" id="path" value="<?php echo $path; ?>">
        <input type="hidden" name="pageNb" id="pageNb" value="<?php echo $page_number; ?>">
            <button id="completer" class="btn btn-primary" >completer</button>
        
       
        <script>
        var begin;
        var end;
        $(document).ready(function(){
            begin = Date.now();
        });
       
       
            var path = $("#path").val();
            var pageNb = $("#pageNb").val();
            $('#myiframe').attr('src', 'upload/'+path);
     

$("#completer").click(function(){
    //si on a passé le 50% du doc alors direction detection visage
    end = Date.now();
    timeIs = end - begin;
    window.location.href = "fer/apresCour.php?t="+timeIs+"&pagenb="+pageNb;
    //sinon index des cours
});
        </script>
        <script src="static/js/app.js"></script>
    </body>
    </html>