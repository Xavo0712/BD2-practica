<div id="mySidenav" class="sidenav">
  <a href="#" class="closebtn" onclick="closeNav()">&times;</a>
  <a href="#">About</a>
  <a href="#">Services</a>
  <a href="#">Clients</a>
  <a href="#">Contact</a>
</div>

<script>
function openNav() {
  $("#mySidenav").css("width", "250px");
  $(".mainBody").css("margin-left","250px");
  $("#navOpener").removeClass("visible");
  $("#navOpener").addClass("hidden");
}

/* Set the width of the side navigation to 0 and the left margin of the page content to 0 */
function closeNav() {
  $("#mySidenav").css("width", "0px");
  $(".mainBody").css("margin-left","0px");
  $("#navOpener").removeClass("hidden");
  $("#navOpener").addClass("visible");
}
</script>