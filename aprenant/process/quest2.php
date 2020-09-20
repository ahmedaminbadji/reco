<?php 

require_once("../../config/db.php");
    $q1 = $_POST["group1"];
    $q2 = $_POST["group2"];
    $q3 = $_POST["group3"];
    $q4 = $_POST["group4"];
    $q5 = $_POST["group5"];
    if(($q1 == 1 || $q2 == 1) && ($q3 == 0 && $q4 ==0 && $q5 == 0)){
        echo "solution 1"; 
    }else{
        if(($q3 ==1 || $q4 ==1 || $q5 == 1) && ($q1 ==0 && $q2 ==0)){
            echo "solution 2"; 
        }else{
            
                if(($q1 = 1 || $q2 = 1) && ($q3 == 1 ||$q4 ==1 || $q5 == 1)){
                    echo "solution 1 + solution 2"; 
                    $pdo = Config::getPdo();
                    $query = "UPDATE `aprenant` SET `besoin_aide`=? WHERE `id_utilisateur`=?";
                    $sql = $pdo->prepare($query);
                    $c = $sql->execute([1,$_SESSION["id_user"]]);
                }else{
                    echo "ok";
                   ?>
                   <script>
                       if (confirm("Est ce que vous avez compris le cour ?") == true) {
                            
                        window.location.href = "../index.php";
                        } else {
                            
                            
                            window.location.href = "../recomended.php";
                        }
                   </script>
                   <?php
                }
                //redirect
            
        }
    }

?>