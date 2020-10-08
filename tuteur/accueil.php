<?php 
session_start();
if(isset($_SESSION["role"]) && $_SESSION["role"] == "tuteur"){

?>
<div class="container">
    <br><br>
        <div class="offset-md-3 col-md-6 text-white" style="background-color:rgba(123, 96, 84, 0.83); padding:2% 2% 2% 2%;">
        <center><b> Bienvenue dans votre espace tuteur</b></center>
        <br>
        <center>
           <b> Date : </b><?php echo date("Y.m.d");?>
           <br>
           <b>Heure : </b> <?php echo  date("h:i") ?>
        </center>
    </div>
  
</div>
<?php
    }else{
      echo "not authorized";
    }
    ?>