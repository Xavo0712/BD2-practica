<div id="myChat" class="chat container">
  <div class="panel panel-default border">
    <div id="chatHeader" class="panel-heading chat-header col-12">
      <i class="fa-solid fa-arrow-left text-center"></i>
      <h5 class="text-center">User198</h5>
      <i id="downChat" class="fa-solid fa-chevron-down text-center"></i>
      <i id="upChat" class="fa-solid fa-chevron-up text-center" style="display:none"></i>
    </div>
    <div id="chatBody" class="panel-body chat-body">
      <div class="sent-message">
        <p>Hola! Cómo fue la tarde?? Bien?</p>
      </div>
      <div class="received-message">
        <p>Hola! Ahora que lo mencionas, fue bastante mejor de lo que esperaba.</p>
      </div>
    </div>
    <div id="classFooter" class="panel-footer chat-footer">
      <input id="chatWriter" placeholder="Escriba un mensaje"></input>
    </div>
  </div>
</div>

<script>
  $('#downChat').click(function() {
    $('#myChat').addClass('folded');
    $('#chatBody').addClass('folded');
    $('#classFooter').addClass('folded');
    $('#chatHeader').addClass('folded');

    $('#downChat').css('display','none');
    $('#upChat').css('display','table-cell');
  });

  $('#upChat').click(function() {
    $('#myChat').removeClass('folded');
    $('#chatBody').removeClass('folded');
    $('#classFooter').removeClass('folded');
    $('#chatHeader').removeClass('folded');

    $('#downChat').css('display','table-cell');
    $('#upChat').css('display','none');
  });
</script>