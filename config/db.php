<?php 
   class Config{
      
      public static function getPdo()
      {
         try{
            $options = array(
                PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
                );
           $pdo = new PDO("mysql:host=localhost;dbname=reco","root","amine07!",$options);
         }
         catch(PDOException $e){
            echo $e->getMessage();
         }
         return $pdo;
      }

      }
      
   //connexion base de donnée
   
?>