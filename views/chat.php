<!--DO SAME AS chatPage-->
<script>
  function enterChat(sender, receiver) {
    $.ajax({
      url: "../server/seenUpdate.php",
      type: "GET",
      data: {
        idS: sender,
        idR: receiver
      },
      success: function() {
        console.log("Seen sent successfully")
      }
    });
  }

  function enterChat(sender, receiver, logged) {
    $.ajax({
      url: "../server/seenUpdate.php",
      type: "GET",
      data: {
        loggedUser: logged,
        idS: sender,
        idR: receiver
      },
      success: function() {
        console.log("Seen sent successfully")
      }
    });
  }
</script>
<?php $currentChat = 1 ?>
<div id="myChat" class="chat container">
  <div class="panel panel-default border">
    <div id="chatHeader" class="panel-heading chat-header col-12">
      <a id="backChat" href="javascript:void(0)" style="text-decoration: none; display:none;"><i class="fa-solid fa-arrow-left text-center"></i></a>
      <h5 id="chatHeaderText" class="text-center">Chats</h5>
      <a id="downChat" href="javascript:void(0)" style="text-decoration: none;"><i class="fa-solid fa-chevron-down text-center"></i></a>
      <a id="upChat" href="javascript:void(0)" style="text-decoration: none; display:none;"><i class="fa-solid fa-chevron-up text-center"></i></a>
    </div>
    <div id="miniChat" style="overflow-y:scroll; height:505px; background-color:#332f2f;">
      <?php
      $userChats = array();
      $loggedUser = $_COOKIE['user']; //paco as user for test purpouse
      $loggedUsername = DB::run("SELECT username FROM usuari WHERE idUser = ?", [$loggedUser])->fetchAll(PDO::FETCH_ASSOC)[0]['username'];
      $query = DB::run("CALL getChats(?)", [$loggedUser]);
      $statement = $query->fetchAll(PDO::FETCH_ASSOC);
      $query->closeCursor();
      //Washing statement so it only contains last message of each chat of current user
      $lastMsgs = array();
      foreach ($statement as $row) {
        $push = true;
        foreach ($statement as $check) {
          if ((($check['sId'] == $row['sId'] &&
              $check['rId'] == $row['rId']) ||
              ($check['sId'] == $row['rId'] && $check['rId'] == $row['sId'])) &&
            $check['timeSent'] > $row['timeSent']
          ) {
            $push = false;
          }
        }
        if ($push) {
          array_push($lastMsgs, $row);
        }
      }
      foreach ($lastMsgs as $row) {
        if ($loggedUsername == $row['sender']) {
          $otherUser = $row['receiver'];
          $otherUserId = $row['rId'];
          $otherUserImg = $row['rImg'];
          $leido = $row['leidoE'];
        } else {
          $otherUser = $row['sender'];
          $otherUserId = $row['sId'];
          $otherUserImg = $row['sImg'];
          $leido = $row['leidoR'];
        }
        $time = substr($row['lastTime'], 3, 2);

        array_push($userChats, $otherUserId);
        echo "<div id=\"" . $otherUserId . "\" class=\"chat-info row\" name=\"" . $otherUser . "\">\n";
        echo "  <div class=\"col-lg-2\">\n";
        echo "    <img class=\"userPic\" src=\"" . $otherUserImg . "\" width=\"50px\" height=\"50px\" />\n";
        echo "  </div>\n";
        echo "<div class=\"row col-lg-8\">\n";
        echo "    <div class=\"username\">\n";
        echo $otherUser . "\n";
        echo "    </div>\n";
        echo "    <div class=\"lastMessage\">\n";
        echo $row['text'] . "\n";
        echo "    </div>\n";
        echo "  </div>\n";
        if ($leido == 0) {
          echo "  <div id=\"seenMsg" . $otherUserId . "\" class=\"row col-lg-2\" style=\"display:block;\">\n";
          echo "    <div class=\"messageInfo\">\n";
          if ($time == "00") {
            echo "      Just now\n";
          } else {
            echo "      " . $time . " min\n";
          }
          echo "    </div>\n";
          echo "    <img src=\"https://upload.wikimedia.org/wikipedia/commons/thumb/c/c3/Location_dot_dark_red.svg/2048px-Location_dot_dark_red.svg.png\" width:\"10px\" height=\"15px\" />\n";
          echo "  </div>\n";
        }
        echo "</div>\n";
      }
      ?>
    </div>
    <?php
    foreach ($userChats as $chat) {
      echo "<div id=\"chatPersonal" . $chat . "\" style=\"display:none; background-color:#332f2f;\" class=\"chatPersonal\">\n
      <div id=\"chatBody" . $chat . "\" style=\"overflow-y:scroll; height:455px;\" class=\"panel-body chat-body\">\n";
      $currentChat = $chat;
      foreach ($statement as $message) {
        if ($message['sId'] == $currentChat || $message['rId'] == $currentChat) {
          if ($message['sId'] == $loggedUser && $message['text'] != "") {
            echo "<script>enterChat(" . $loggedUser . "," . $chat . "," . $loggedUser . ")</script>";
            echo "    <div class=\"sent-message\">\n";
            echo "    <p>" . $message['text'] . "</p>\n";
            echo "    </div>\n";
          } else if ($message['text'] != "") {
            echo "<script>enterChat(" . $chat . "," . $loggedUser . "," . $loggedUser . ")</script>";
            echo "    <div class=\"received-message\">\n";
            echo "    <p>" . $message['text'] . "</p>\n";
            echo "    </div>\n";
          }
        }
      }
    ?>
  </div>
  <div id="classFooter<?php echo $chat ?>" class="panel-footer chat-footer">
    <input id="chatWriter<?php echo $chat ?>" placeholder="Escriba un mensaje" onkeypress="enterMessage(event, 'chatWriter<?php echo $chat ?>', <?php echo $loggedUser ?>,<?php echo $currentChat ?>)"></input>
  </div>
</div>
<?php } ?>
</div>
</div>

<script>
  setTimeout(function(){
   window.location.reload(1);
  }, 30000);

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
    console.log("Clicado: " + $(this).attr('id') + ", mostrando a " + '#chatPersonal' + $(this).attr('id'));
    $('#miniChat').css('display', 'none');
    $('#chatPersonal' + $(this).attr('id')).css('display', 'block');
    $('#seenMsg' + $(this).attr('id')).css('display', 'none');
    enterChat(<?php echo $loggedUser ?>, $(this).attr('id'));
  });

  function enterMessage(event, id, sender, receiver) {
    if (event.keyCode == 13) {
      var msg = document.getElementById(id).value;
      $.ajax({
        url: "../server/msgInsert.php",
        type: "GET",
        data: {
          text: msg,
          idS: sender,
          idR: receiver
        },
        success: function() {
          console.log("Message sent successfully")
        }
      });
      var idN = id.substr(10);
      var chatId = 'chatBody' + idN;
      var sentMessageP = document.createElement('p');
      sentMessageP.innerHTML = msg;
      var sentMessageDiv = document.createElement('div');
      sentMessageDiv.className = 'sent-message';
      sentMessageDiv.appendChild(sentMessageP);
      document.getElementById(chatId).appendChild(sentMessageDiv);
      sentMessageDiv.scrollIntoView({
        behavior: "smooth"
      });
      var lastMsg = (document.getElementById(idN)).getElementsByClassName('lastMessage');
      lastMsg[0].innerHTML = msg;
      document.getElementById(id).value = "";
    }
  }
</script>