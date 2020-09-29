<?php 

require_once("../../config/db.php");
    $q1 = $_POST["group1"];
    $q2 = $_POST["group2"];
    $q3 = $_POST["group3"];
    $q4 = $_POST["group4"];
    $q5 = $_POST["group5"];
    if(($q1 == 1 || $q2 == 1) && ($q3 == 0 && $q4 ==0 && $q5 == 0)){
        header('Location: ../relax.php'); 
    }else{
        if(($q3 ==1 || $q4 ==1 || $q5 == 1) && ($q1 ==0 && $q2 ==0)){
            $pdo = Config::getPdo();
            $query = "UPDATE `aprenant` SET `besoin_aide`=? WHERE `id_utilisateur`=?";
            $sql = $pdo->prepare($query);
            $c = $sql->execute([1,$_SESSION["id_user"]]);


            $query = "SELECT * FROM `users` WHERE `id_utilisateur`=?";
            $sql = $pdo->prepare($query);
            $sql->execute([1,$_SESSION["id_user"]]);
            $result = $sql->fetch(PDO::FETCH_ASSOC);


            $to = $result["email"];
            $subject = "RDV Tuteur";
            $txt = "On vous invite a prendre RDV avec votre tuteur . votre tuteur est informé de votre situation";
            $headers = "From: admin@recomondation.com" . "\r\n" .
            "CC: somebodyelse@example.com";

            mail($to,$subject,$txt,$headers);
        }else{
            
                if(($q1 == 1 || $q2 == 1) && ($q3 == 1 ||$q4 ==1 || $q5 == 1)){
                    echo "solution 1 + solution 2"; 
                    $pdo = Config::getPdo();
                    $query = "UPDATE `aprenant` SET `besoin_aide`=? WHERE `id_utilisateur`=?";
                    $sql = $pdo->prepare($query);
                    $c = $sql->execute([1,$_SESSION["id_user"]]);
                    $query = "SELECT * FROM `users` WHERE `id_utilisateur`=?";
            $sql = $pdo->prepare($query);
            $sql->execute([1,$_SESSION["id_user"]]);
            $result = $sql->fetch(PDO::FETCH_ASSOC);


            $to = $result["email"];
            $subject = "RDV Tuteur";
            $txt = "On vous invite a prendre RDV avec votre tuteur . votre tuteur est informé de votre situation";
            $headers = "From: admin@recomondation.com" . "\r\n" .
            "CC: somebodyelse@example.com";

            //mail($to,$subject,$txt,$headers);
            header('Location: ../relax.php'); 

                }else{
                    if($q4 == 1 ){
                        //afficher changement de groupe 
                        //redirect vers changement groupe
                    }
                    header('Location: ../index.php'); 
                }
                //redirect
            
        }
    }

?>