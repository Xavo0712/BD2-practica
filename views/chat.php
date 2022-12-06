<?php $currentChat = 1 ?>
<div id="myChat" class="chat container">
  <div class="panel panel-default border">
    <div id="chatHeader" class="panel-heading chat-header col-12">
      <a id="backChat" href="javascript:void(0)" style="text-decoration: none; display:none;"><i class="fa-solid fa-arrow-left text-center"></i></a>
      <h5 id="chatHeaderText" class="text-center">Chats</h5>
      <a id="downChat" href="javascript:void(0)" style="text-decoration: none;"><i class="fa-solid fa-chevron-down text-center"></i></a>
      <a id="upChat" href="javascript:void(0)" style="text-decoration: none; display:none;"><i class="fa-solid fa-chevron-up text-center"></i></a>
    </div>
    <div id="miniChat" style="overflow-y:scroll; height:505px;">
      <?php
      $userChats = array();
      $loggedUser = 1; //paco as user for test purpouse
      $loggedUsername = DB::run("SELECT username FROM usuari WHERE idUser = ?", [$loggedUser])->fetchAll(PDO::FETCH_ASSOC)[0]['username'];
      $query = DB::run("SELECT senders.idUser AS sId, senders.username AS sender, receivers.idUser AS rId, receivers.username AS receiver, missatge.idMsg, missatge.text, missatge.timeSent 
      FROM missatge JOIN usuari AS senders ON (missatge.idUserE = ? OR missatge.idUserR = ?) AND missatge.idUserE = senders.idUser 
      JOIN usuari AS receivers ON missatge.idUserR = receivers.idUser;", [$loggedUser, $loggedUser]); //opcionalmente ORDER BY para usuarios por orden de algo...
      $statement = $query->fetchAll(PDO::FETCH_ASSOC);
      //Washing statement so it only contains last message of each chat of current user
      $lastMsgs = array();
      foreach($statement as $row){
        $push = true;
        foreach($statement as $check){          
          if(($check['sId'] == $row['sId'] || $check['rId'] == $row['sId']) && 
          ($check['rId'] == $row['rId'] || $check['rId'] == $row['sId']) && 
          $check['timeSent'] > $row['timeSent']){
            $push = false;
          }
        }
        if($push){
          array_push($lastMsgs, $row);
        }
      }
      foreach ($lastMsgs as $row) {
        if($loggedUsername == $row['sender']){
          $otherUser = $row['receiver'];
          $otherUserId = $row['rId'];
        }
        else{
          $otherUser = $row['sender'];
          $otherUserId = $row['sId'];
        }
        array_push($userChats, $otherUserId);
        echo "<div id=\"" . $otherUserId . "\" class=\"chat-info row\" name=\"" . $otherUser . "\">\n";
        echo "  <div class=\"userPic col-lg-2\">\n";
        echo "    <img src=\"https://cdn-icons-png.flaticon.com/512/235/235359.png\" width=\"50px\" height=\"50px\" />\n";
        echo "  </div>\n";
        echo "<div class=\"row col-lg-8\">\n";
        echo "    <div class=\"username\">\n";
        echo $otherUser . "\n";
        echo "    </div>\n";
        echo "    <div class=\"lastMessage\">\n";
        echo $row['text']."\n";
        echo "    </div>\n";
        echo "  </div>\n";
        echo "  <div class=\"row col-lg-2\">\n";
        echo "    <div class=\"messageInfo\">\n";
        echo "      10min\n"; //ya si, poner la fecha
        echo "    </div>\n";
        echo "    <img src=\"https://upload.wikimedia.org/wikipedia/commons/thumb/c/c3/Location_dot_dark_red.svg/2048px-Location_dot_dark_red.svg.png\" width=\"15px\" height=\"10px\" />\n";
        echo "  </div>\n";
        echo "</div>\n";
      }
        ?>
      </div>

      <?php 
      foreach($userChats as $chat){
      echo "<div id=\"chatPersonal".$chat."\" style=\"display:none;\" class=\"chatPersonal\">\n
      <div id=\"chatBody\" style=\"overflow-y:scroll; height:455px;\" class=\"panel-body chat-body\">\n";
      $currentChat = $chat;
      foreach ($statement as $message) {
        if($message['sId'] == $currentChat || $message['rId'] == $currentChat){
          if ($message['sId'] == $loggedUser) {
            echo "    <div class=\"sent-message\">\n";
            echo "    <p>" . $message['text'] . "</p>\n";
            echo "    </div>\n";
          } else {
            echo "    <div class=\"received-message\">\n";
            echo "    <p>" . $message['text'] . "</p>\n";
            echo "    </div>\n";
          }
        }
      }
    
      ?>
      <!--TODO: Fix footer padding  and position -->
      <div id="classFooter<?php echo $chat?>" class="panel-footer chat-footer">
        <input id="chatWriter" placeholder="Escriba un mensaje"></input>
      </div>
  </div>
    </div>
    <?php } ?>
  </div>
</div>

<script>
  $('#downChat').click(function() {
    $('#myChat').addClass('folded');
    $('#classFooter').addClass('folded');
    $('#chatHeader').addClass('folded');

    $('#downChat').css('display', 'none');
    $('#upChat').css('display', 'inherit');
  });

  $('#upChat').click(function() {
    $('#myChat').removeClass('folded');
    $('#classFooter').removeClass('folded');
    $('#chatHeader').removeClass('folded');

    $('#downChat').css('display', 'inherit');
    $('#upChat').css('display', 'none');
  });

  $('#backChat').click(function() {
    $('#backChat').css('display', 'none');
    $('#chatHeaderText').text('Chats');
    $('#miniChat').css('display', 'block');
    $('.chatPersonal').css('display', 'none');
  });

  $('.chat-info').click(function() {
    $('#backChat').css('display', 'inherit');
    $('#chatHeaderText').text($(this).attr('name'));
    $('#chatPersonal').attr('name');
    console.log("Clicado: "+$(this).attr('id')+", mostrando a "+'#chatPersonal'+$(this).attr('id'));
    $('#miniChat').css('display', 'none');
    $('#chatPersonal'+$(this).attr('id')).css('display', 'block');
  });
</script>