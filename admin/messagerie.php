<?php session_start();
include("../config/db.php");
if(isset($_SESSION["role"]) && $_SESSION["role"] == "admin"){
}   
}else{
  echo "not authorized";
}
?>

