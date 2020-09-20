<?php 
include("../config/db.php");
session_start();
class Auth {
    public static function authenticate($user,$pass)
    {
        if(!empty($user) && !empty($pass)){ 
            
            $pdo = Config::getPdo();            
            $query="SELECT * FROM `users` WHERE `pseudo`=?";
            $sql = $pdo->prepare($query);
            $sql->execute(array($user));
            if($sql->rowCount() == 1){
                    $result = $sql->fetch(PDO::FETCH_ASSOC);
                    $hash = $result['motpass'];
                    if(password_verify ($pass , $hash )){

                        //connected
                        if($result["confirmed"]){
                            
                        $_SESSION["user"]= $result["pseudo"];
                        $_SESSION["user_id"] = $result["id_utilisateur"];
                        switch ($result["type"]) {
                            case "ens":
                                echo "ens";
                                $_SESSION["role"]= $result["ens"];
                                break;
                            case "aprenant":
                                echo "aprenant";
                                $_SESSION["role"]= $result["aprenant"];
                                if($result["last_login"]==null){
                                    header('Location: ../fer/test.php'); 
                                }else{
                                //besoin aide session
                                //specialité session
                                header('Location: ../aprenant/'); 
                                }
                                break;
                            case "admin":
                                $_SESSION["role"]= "admin";
                                header('Location: ../admin/'); 
                                break;
                            case "tuteur": 
                                $_SESSION["role"]= $result["tuteur"];
                                echo "tuteur";
                        }
                    }else{
                        return "not confirmed";
                    }
                    }else{
                        return "Incorrect password";
                    }
            }else{
                return "user incorrect";
            }
        }
    }
}
?>