<?php require_once __DIR__ . "/header.php" ?>
<html>


<div class="formulario">
  <div class="abs-center">
    <form action="historia.php" method="post">
      <input class="form-control" type="text" placeholder="Titulo">
      <label for="exampleFormHistories">Selecciona tipo:</label><br>
      <select id="exampleFormHistories">
        <option selected value="value0">Publica</option>
        <option value="value1" ">Privada</option>
      </select><br>


      <div>
      <a href="main.php"><button class="cancelbtn" type="button" >Cancelar</button></a>
      <button type="submit" name="boton_crear">Crear historia </button>
      </div>     
    </form>
  </div>
</div>

</html>