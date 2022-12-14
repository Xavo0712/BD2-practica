<div style="min-width: 100%">
    <?php require_once __DIR__ . "/header.php" ?>

    <body class="mainBody">
        <div class="row">
            <div class="panel panel-default col-lg-6">
                <div id="chats" style="overflow-y:scroll; height:875px;">

                    <?php
                    $userChats = array();
                    $loggedUser = $_SESSION['user']; //poner como storedProcedure en mysql, SELECT ENORME
                    $loggedUsername = DB::run("SELECT username FROM usuari WHERE idUser = ?", [$loggedUser])->fetchAll(PDO::FETCH_ASSOC)[0]['username'];
                    $query = DB::run("SELECT senders.idUser AS sId, senders.username AS sender, receivers.idUser AS rId, receivers.username AS receiver, missatge.idMsg, missatge.text, missatge.timeSent 
      FROM missatge JOIN usuari AS senders ON (missatge.idUserE = ? OR missatge.idUserR = ?) AND missatge.idUserE = senders.idUser 
      JOIN usuari AS receivers ON missatge.idUserR = receivers.idUser ORDER BY missatge.timeSent;", [$loggedUser, $loggedUser]); //opcionalmente ORDER BY para usuarios por orden de algo...
                    $statement = $query->fetchAll(PDO::FETCH_ASSOC);
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
                        } else {
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
                        echo $row['text'] . "\n";
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
                    <div class="chat-info row">
                        <div class="userPic col-lg-2">
                            <img src="https://cdn-icons-png.flaticon.com/512/235/235359.png" width="80px"
                                height="80px" />
                        </div>
                        <div class="row col-lg-8">
                            <div class="username">
                                CapybaraGigaChad
                            </div>
                            <div class="lastMessage">
                                We love capys ^^
                            </div>
                        </div>
                        <div class="row col-lg-2">
                            <div class="messageInfo">
                                10min
                            </div>
                            <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/c/c3/Location_dot_dark_red.svg/2048px-Location_dot_dark_red.svg.png"
                                height="20px" style="width:auto;" />
                        </div>
                    </div>

                </div>
            </div>
            <div id="messages" class="panel panel-default col-lg-6" style="display:none;">
                <div id="chatBody" style="overflow-y:scroll; height:810px;" class="panel-body chat-body">
                    <div class="sent-message">
                        <p>Do you love Capys?</p>
                    </div>
                    <div class="received-message">
                        <p>We love capys ^^</p>
                    </div>
                    <div class="sent-message">
                        <p>Do you love Capys?</p>
                    </div>
                    <div class="received-message">
                        <p>We love capys ^^</p>
                    </div>
                    <div class="sent-message">
                        <p>Do you love Capys?</p>
                    </div>
                    <div class="received-message">
                        <p>We love capys ^^</p>
                    </div>
                    <div class="sent-message">
                        <p>Do you love Capys?</p>
                    </div>
                    <div class="received-message">
                        <p>We love capys ^^</p>
                    </div>
                    <div class="sent-message">
                        <p>Do you love Capys?</p>
                    </div>
                    <div class="received-message">
                        <p>We love capys ^^</p>
                    </div>
                    <div class="sent-message">
                        <p>Do you love Capys?</p>
                    </div>
                    <div class="received-message">
                        <p>We love capys ^^</p>
                    </div>
                </div>
                <div id="classFooter" class="panel-footer chat-footer">
                    <input id="chatWriter" placeholder="Escriba un mensaje"></input>
                </div>
            </div>
        </div>
    </body>
</div>

<script>
$('.chat-info').click(function() {
    $('#messages').css('display', 'block');
});
</script>