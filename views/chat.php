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
        $query = DB::run("SELECT username, missatge.text AS msg, missatge.idMsg 
        FROM (usuari JOIN missatge ON usuari.idUser = missatge.idUserR) 
        LEFT JOIN missatge AS m ON missatge.idUserR = m.idUserR AND m.idMsg > missatge.idMsg 
        WHERE m.idMsg IS NULL");//opcionalmente ORDER BY para usuarios por orden de algo...
        $lastMsgs = $query->fetchAll(PDO::FETCH_ASSOC);
        foreach($lastMsgs as $row){
          echo "<div class=\"chat-info row\">";
          echo "  <div class=\"userPic col-lg-2\">";
          echo "    <img src=\"https://cdn-icons-png.flaticon.com/512/235/235359.png\" width=\"50px\" height=\"50px\" />";
          echo "  </div>";
          echo "<div class=\"row col-lg-8\">";
          echo "    <div class=\"username\">";
          echo $row['username'];
          echo "    </div>";
          echo "    <div class=\"lastMessage\">";
          echo $row['msg'];
          echo "    </div>";
          echo "  </div>";
          echo "  <div class=\"row col-lg-2\">";
          echo "    <div class=\"messageInfo\">";
          echo "      10min"; //no implementado en BD actual sin calculos adicionales
          echo "    </div>";
          echo "    <img src=\"https://upload.wikimedia.org/wikipedia/commons/thumb/c/c3/Location_dot_dark_red.svg/2048px-Location_dot_dark_red.svg.png\" width=\"15px\" height=\"10px\" />";
          echo "  </div>";
          echo "</div>";
        }
      ?>
      <div class="chat-info row">
        <div class="userPic col-lg-2">
          <img src="https://cdn-icons-png.flaticon.com/512/235/235359.png" width="50px" height="50px" />
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
          <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/c/c3/Location_dot_dark_red.svg/2048px-Location_dot_dark_red.svg.png" width="15px" height="10px" />
        </div>
      </div>
      <div class="chat-info row">
        <div class="userPic col-lg-2">
          <img src="https://cdn-icons-png.flaticon.com/512/235/235359.png" width="50px" height="50px" />
        </div>
        <div class="row col-lg-8">
          <div class="username">
            CapybaraGigaChad
          </div>
          <div class="lastMessage">
            We love capys ^^
          </div>
        </div>
      </div>
      <div class="chat-info row">
        <div class="userPic col-lg-2">
          <img src="https://cdn-icons-png.flaticon.com/512/235/235359.png" width="50px" height="50px" />
        </div>
        <div class="row col-lg-8">
          <div class="username">
            CapybaraGigaChad
          </div>
          <div class="lastMessage">
            We love capys ^^
          </div>
        </div>
      </div>
      <div class="chat-info row">
        <div class="userPic col-lg-2">
          <img src="https://cdn-icons-png.flaticon.com/512/235/235359.png" width="50px" height="50px" />
        </div>
        <div class="row col-lg-8">
          <div class="username">
            CapybaraGigaChad
          </div>
          <div class="lastMessage">
            We love capys ^^
          </div>
        </div>
      </div>
      <div class="chat-info row">
        <div class="userPic col-lg-2">
          <img src="https://cdn-icons-png.flaticon.com/512/235/235359.png" width="50px" height="50px" />
        </div>
        <div class="row col-lg-8">
          <div class="username">
            CapybaraGigaChad
          </div>
          <div class="lastMessage">
            We love capys ^^
          </div>
        </div>
      </div>
      <div class="chat-info row">
        <div class="userPic col-lg-2">
          <img src="https://cdn-icons-png.flaticon.com/512/235/235359.png" width="50px" height="50px" />
        </div>
        <div class="row col-lg-8">
          <div class="username">
            CapybaraGigaChad
          </div>
          <div class="lastMessage">
            We love capys ^^
          </div>
        </div>
      </div>
      <div class="chat-info row">
        <div class="userPic col-lg-2">
          <img src="https://cdn-icons-png.flaticon.com/512/235/235359.png" width="50px" height="50px" />
        </div>
        <div class="row col-lg-8">
          <div class="username">
            CapybaraGigaChad
          </div>
          <div class="lastMessage">
            We love capys ^^
          </div>
        </div>
      </div>
      <div class="chat-info row">
        <div class="userPic col-lg-2">
          <img src="https://cdn-icons-png.flaticon.com/512/235/235359.png" width="50px" height="50px" />
        </div>
        <div class="row col-lg-8">
          <div class="username">
            CapybaraGigaChad
          </div>
          <div class="lastMessage">
            We love capys ^^
          </div>
        </div>
      </div>
      <div class="chat-info row">
        <div class="userPic col-lg-2">
          <img src="https://cdn-icons-png.flaticon.com/512/235/235359.png" width="50px" height="50px" />
        </div>
        <div class="row col-lg-8">
          <div class="username">
            CapybaraGigaChad
          </div>
          <div class="lastMessage">
            We love capys ^^
          </div>
        </div>
      </div>
      <div class="chat-info row">
        <div class="userPic col-lg-2">
          <img src="https://cdn-icons-png.flaticon.com/512/235/235359.png" width="50px" height="50px" />
        </div>
        <div class="row col-lg-8">
          <div class="username">
            CapybaraGigaChad
          </div>
          <div class="lastMessage">
            We love capys ^^
          </div>
        </div>
      </div>
      <div class="chat-info row">
        <div class="userPic col-lg-2">
          <img src="https://cdn-icons-png.flaticon.com/512/235/235359.png" width="50px" height="50px" />
        </div>
        <div class="row col-lg-8">
          <div class="username">
            CapybaraGigaChad
          </div>
          <div class="lastMessage">
            We love capys ^^
          </div>
        </div>
      </div>
      <div class="chat-info row">
        <div class="userPic col-lg-2">
          <img src="https://cdn-icons-png.flaticon.com/512/235/235359.png" width="50px" height="50px" />
        </div>
        <div class="row col-lg-8">
          <div class="username">
            CapybaraGigaChad
          </div>
          <div class="lastMessage">
            We love capys ^^
          </div>
        </div>
      </div>
    </div>
    <div id="chatPersonal" style="display:none;">
      <div id="chatBody" style="overflow-y:scroll; height:455px;" class="panel-body chat-body">
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
    $('#chatPersonal').css('display', 'none');
  });

  $('.chat-info').click(function() {
    $('#backChat').css('display', 'inherit');
    $('#chatHeaderText').text('CapybaraGigaChad');
    $('#miniChat').css('display', 'none');
    $('#chatPersonal').css('display', 'block');
  });
</script>