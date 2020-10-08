<?php 
include("../config/db.php");
session_start();
if(isset($_SESSION["role"]) && $_SESSION["role"] == "tuteur"){

$id=0;
if(isset($_GET["id"])){
    $id = $_GET["id"];
}
?>
<html>
 <head>
        <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
        <title>Aprenant</title>
        <link rel="stylesheet" href="../static/css/bootstrap.min.css">
        <link rel="stylesheet" href="../static/css/simple-sidebar.css">
        <script src="../static/js/jquery.js"></script>
        <script src="../static/js/bootstrap.min.js"></script>
    </head>
    <body>
           <a href="index.php">  <button class="btn btn-danger float-left">Retour</button></a>
<h3 class="text-center">Messagerie</h3>
<div class="messaging">
      <div class="inbox_msg">
        <div class="inbox_people">
          <div class="headind_srch">
            <div class="recent_heading">
              <h4>Recent</h4>
            </div>
     
          </div>
          <div class="inbox_chat">
          <?php 
                                          $pdo = Config::getPdo();
                                          $query = "SELECT * from `messages` WHERE `sender`=? GROUP BY `reciver` ORDER BY `id` ASC ";
                                          $query2 = "SELECT * from `messages` WHERE `reciver`=? GROUP BY `sender` ORDER BY `id` ASC ";
                                          $sql = $pdo->prepare($query);
                                          $sql2 = $pdo->prepare($query2);
                                          $sql->execute([$_SESSION["id_user"]]);
                                          $sql2->execute([$_SESSION["id_user"]]);
                                          $result = $sql->fetchAll(PDO::FETCH_ASSOC);
                                          $result2 = $sql2->fetchAll(PDO::FETCH_ASSOC);

                                          $merged_results = array_merge($result, $result2);
                                          foreach($merged_results as $descuss){
                                            
                                         ?>
            <div class="chat_list">
              <div class="chat_people">
                <div class="chat_img"> <img src="https://ptetutorials.com/images/user-profile.png" alt="sunil"> </div>
                <div class="chat_ib">
                  <h5><?php 
                  if($descuss["sender"]!=$_SESSION["id_user"]){
                       $query = "SELECT * from `users` WHERE `id_utilisateur`=?";
                       $sql = $pdo->prepare($query);
                       $sql->execute([$descuss["sender"]]);
                       $result = $sql->fetch(PDO::FETCH_ASSOC);
                      ?> <a href="messagerie.php?id=<?php echo $descuss["sender"]; ?>"> <?php echo $result["nom"]." ".$result["prenom"]; ?></a> 
                      <?php
                  }else{
                    $query = "SELECT * from `users` WHERE `id_utilisateur`=?";
                    $sql = $pdo->prepare($query);
                    $sql->execute([$descuss["reciver"]]);
                    $result = $sql->fetch(PDO::FETCH_ASSOC);
                    ?> <a href="messagerie.php?id=<?php echo $descuss["reciver"]; ?>"> <?php echo $result["nom"]." ".$result["prenom"];?></a> 
                    <?php
                  } 
                  
                  ?> <span class="chat_date"><?php 
                    echo $descuss["date_msg"];
                  ?></span></h5>
                </div>
              </div>
            </div>
           <?php 
           }
           ?>
          </div>
        </div>
        <div class="mesgs">
          <div class="msg_history">
          <?php 
          $query = "SELECT * FROM `messages` WHERE `sender`=? AND `reciver`=? OR `sender`=? AND `reciver`=? ORDER BY `id` DESC";
          $sql = $pdo->prepare($query);
          $sql->execute([$_SESSION["id_user"],$id,$id,$_SESSION["id_user"]]);  
          $result = $sql->fetchAll(PDO::FETCH_ASSOC);
          foreach($result as $msg){
            if($msg["sender"]==$_SESSION["id_user"]){
                ?>
                 <div class="outgoing_msg">
              <div class="sent_msg">
                <p><?php
                echo $msg["message"];
                ?></p>
                <span class="time_date"><?php
                echo $msg["time_msg"];
                ?>    |    <?php
                echo $msg["date_msg"];
                ?></span> </div>
            </div>
                <?php
            }else{
                ?>
 <div class="incoming_msg">
              <div class="incoming_msg_img"> <img src="https://ptetutorials.com/images/user-profile.png" alt="sunil"> </div>
              <div class="received_msg">
                <div class="received_withd_msg">
                  <p><?php
                echo $msg["message"];
                ?></p>
                  <span class="time_date"> <?php
                echo $msg["time_msg"];
                ?>   |    <?php
                echo $msg["date_msg"];
                ?></span></div>
              </div>
            </div>
                 <?php
            }
          }                             
          ?>
           
           
            
          </div>
          <div class="type_msg">
            <div class="input_msg_write">
            <form id="sendMsg">
            <input type="hidden" id="sender" name="sender" value="<?php echo $_SESSION["id_user"];?>">
            <input type="hidden" id="reciver" name="reciver" value="<?php echo $id;?>">
              <input type="text" class="write_msg" name="msg" id="msg" placeholder="Type a message" required />
              <button class="btn btn-primary" style="background-color: #05728f !important;">Envoyer</button>
              </form>
            </div>
          </div>
        </div>
      </div>
      
      <script>
      $("#sendMsg").submit(function(){
        msg =  $("#msg").val();
        sender = $("#sender").val();
        reciver = $("#reciver").val();
        if(sender == 0 || reciver ==0 ){
            window.alert("choisir une descussion");
        }else{

        
        $.post("process/sendMsg.php",{msg:msg,sender:sender,reciver:reciver},function(data){
            location.reload();
        });
        return false;
    }
      });
      
      </script>
      
    </div>
    </body>
    <style>
    
    img{ max-width:100%;}
.inbox_people {
  background: #f8f8f8 none repeat scroll 0 0;
  float: left;
  overflow: hidden;
  width: 40%; border-right:1px solid #c4c4c4;
}
.inbox_msg {
  border: 1px solid #c4c4c4;
  clear: both;
  overflow: hidden;
}
.top_spac{ margin: 20px 0 0;}


.recent_heading {float: left; width:40%;}
.srch_bar {
  display: inline-block;
  text-align: right;
  width: 60%; padding:
}
.headind_srch{ padding:10px 29px 10px 20px; overflow:hidden; border-bottom:1px solid #c4c4c4;}

.recent_heading h4 {
  color: #05728f;
  font-size: 21px;
  margin: auto;
}
.srch_bar input{ border:1px solid #cdcdcd; border-width:0 0 1px 0; width:80%; padding:2px 0 4px 6px; background:none;}
.srch_bar .input-group-addon button {
  background: rgba(0, 0, 0, 0) none repeat scroll 0 0;
  border: medium none;
  padding: 0;
  color: #707070;
  font-size: 18px;
}
.srch_bar .input-group-addon { margin: 0 0 0 -27px;}

.chat_ib h5{ font-size:15px; color:#464646; margin:0 0 8px 0;}
.chat_ib h5 span{ font-size:13px; float:right;}
.chat_ib p{ font-size:14px; color:#989898; margin:auto}
.chat_img {
  float: left;
  width: 11%;
}
.chat_ib {
  float: left;
  padding: 0 0 0 15px;
  width: 88%;
}

.chat_people{ overflow:hidden; clear:both;}
.chat_list {
  border-bottom: 1px solid #c4c4c4;
  margin: 0;
  padding: 18px 16px 10px;
}
.inbox_chat { height: 550px; overflow-y: scroll;}

.active_chat{ background:#ebebeb;}

.incoming_msg_img {
  display: inline-block;
  width: 6%;
}
.received_msg {
  display: inline-block;
  padding: 0 0 0 10px;
  vertical-align: top;
  width: 92%;
 }
 .received_withd_msg p {
  background: #ebebeb none repeat scroll 0 0;
  border-radius: 3px;
  color: #646464;
  font-size: 14px;
  margin: 0;
  padding: 5px 10px 5px 12px;
  width: 100%;
}
.time_date {
  color: #747474;
  display: block;
  font-size: 12px;
  margin: 8px 0 0;
}
.received_withd_msg { width: 57%;}
.mesgs {
  float: left;
  padding: 30px 15px 0 25px;
  width: 60%;
}

 .sent_msg p {
  background: #05728f none repeat scroll 0 0;
  border-radius: 3px;
  font-size: 14px;
  margin: 0; color:#fff;
  padding: 5px 10px 5px 12px;
  width:100%;
}
.outgoing_msg{ overflow:hidden; margin:26px 0 26px;}
.sent_msg {
  float: right;
  width: 46%;
}
.input_msg_write input {
  background: rgba(0, 0, 0, 0) none repeat scroll 0 0;
  border: medium none;
  color: #4c4c4c;
  font-size: 15px;
  min-height: 48px;
  width: 88%;
}

.type_msg {border-top: 1px solid #c4c4c4;position: relative;}
.msg_send_btn {
  background: #05728f none repeat scroll 0 0;
  border: medium none;
  border-radius: 50%;
  color: #fff;
  cursor: pointer;
  font-size: 17px;
  height: 33px;
  position: absolute;
  right: 0;
  top: 11px;
  width: 33px;
}
.messaging { padding: 0 0 50px 0;}
.msg_history {
  height: 516px;
  overflow-y: auto;
}
    </style>
    </html>
    <?php
    }else{
      echo "not authorized";
    }
    ?>