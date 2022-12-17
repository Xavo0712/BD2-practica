<?php
//Functions
function checkEqual($array, $rowCheck, $rowName)
{
    $notInside = true;
    $once = false;
    foreach ($array as $row) {
        if ($row[$rowName] == $rowCheck[$rowName]) {
            $notInside = false;
        }
    }
    return $notInside;
}
?>

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
            console.log("Seen sent successfully, sender: " + sender + ", receiver: " + receiver)
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
            console.log("Seen sent successfully from chats")
        }
    });
}
</script>

<div style="min-width: 100%">
    <?php require_once __DIR__ . "/header.php" ?>

    <body class="mainBody">
        <div class="row">
            <div class="panel panel-default col-lg-6">
                <div id="chats" style="overflow-y:scroll; height:875px;">
                    <?php
                    $userChats = array();
                    $loggedUser = $_COOKIE['user']; //poner como storedProcedure en mysql, SELECT ENORME
                    $loggedUsername = DB::run("SELECT username FROM usuari WHERE idUser = ?", [$loggedUser])->fetchAll(PDO::FETCH_ASSOC)[0]['username'];
                    $query = DB::run("CALL getChats(?)", [$loggedUser]); //opcionalmente ORDER BY para usuarios por orden de algo...
                    $statement = $query->fetchAll(PDO::FETCH_ASSOC);
                    //Washing statement so it only contains last message of each chat of current user
                    $lastMsgs = array();
                    foreach ($statement as $row) {
                        $push = true;
                        foreach ($statement as $check) {
                            if ((($check['sId'] == $row['sId'] &&
                                    $check['rId'] == $row['rId']) ||
                                    ($check['sId'] == $row['rId'] && $check['rId'] == $row['sId'])) &&
                                $check['timeSent'] > $row['timeSent'] && checkEqual($lastMsgs, $check, 'timeSent')
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
                        echo "  <div class=\"userPic col-lg-2\">\n";
                        echo "    <img src=\"" . $otherUserImg . "\" width=\"80px\" height=\"80px\" />\n";
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
                            echo "    <img src=\"https://upload.wikimedia.org/wikipedia/commons/thumb/c/c3/Location_dot_dark_red.svg/2048px-Location_dot_dark_red.svg.png\" style=\"width:auto;\" height=\"20px\" />\n";
                            echo "  </div>\n";
                        }
                        echo "</div>\n";
                    }
                    ?>
                </div>
            </div>
            <div id="messages" class="panel panel-default col-lg-6" style="display:none;">
                <?php $rootPath = $_SERVER['DOCUMENT_ROOT'];
                $thisPath = dirname($_SERVER['PHP_SELF']);
                $onlyPath = str_replace($rootPath, '', $thisPath); ?>
                <?php
                foreach ($userChats as $chat) {
                    echo    "<div id=\"chatPersonal" . $chat . "\" style=\"display:none;\" class=\"chatPersonal\">\n
                            <div id=\"chatBody" . $chat . "\" style=\"overflow-y:scroll; height:810px;\" class=\"panel-body chat-body\">\n";
                    $currentChat = $chat;
                    foreach ($statement as $message) {
                        if ($message['sId'] == $currentChat || $message['rId'] == $currentChat) {
                            if ($message['sId'] == $loggedUser && $message['text'] != "") {
                                echo "<script>enterChat(" . $loggedUser . "," . $chat . "," . $loggedUser . ")</script>";
                                echo "    <div class=\"sent-message\">\n";
                                echo "    <p>" . $message['text'] . "</p>\n";
                                echo "    </div>\n";
                            } else if ($message['text'] != "") {
                                echo "<script>enterChat(" . $chat . "," . $loggedUser . ")</script>";
                                echo "    <div class=\"received-message\">\n";
                                echo "    <p>" . $message['text'] . "</p>\n";
                                echo "    </div>\n";
                            }
                        }
                    }
                ?>
            </div>
            <div id="classFooter<?php echo $chat ?>" class="panel-footer chat-footer">
                <input id="chatWriter<?php echo $chat ?>" placeholder="Escriba un mensaje"
                    onkeypress="enterMessage(event, 'chatWriter<?php echo $chat ?>', <?php echo $loggedUser ?>,<?php echo $currentChat ?>)"></input>
            </div>
        </div>
        <?php } ?>
</div>
</div>
</body>
</div>

<script>
$('.chat-info').click(function() {
    $('#messages').css('display', 'block');
    $('#chatPersonal').attr('name');
    console.log("Clicado: " + $(this).attr('id') + ", mostrando a " + '#chatPersonal' + $(this).attr('id'));
    $('.chatPersonal').css('display', 'none');
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
                console.log("Message was: " + msg);
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