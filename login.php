
<?php require('header.php'); ?>

<div class="containerb">

  <h1>Entrá y publica tus escritos 🌈</h1>

<form class="" action="perfil.php" method="post">
<!--<p class="blanco">Nombre Completo:</p>-->

   <div class="form-group">
  <input class="form-control"  type="text" name="nombreusu" value="" placeholder="Usuarie (obligat)">
  <input class="form-control" type="email" name="email" value="" placeholder="E-mail">
  </div>

  
  <input class="form-control" type="password" name="pass" value=""placeholder="Ingresá tu contraseña ">
    <div class="form-check">
    <input  class="form-check-input"type="checkbox" class="form-check-input" name="recordar" value="">
    <label for="recordar" class="form-check-label">Recordarme?</label>
    </div>
 <input class= "btn btn-success" type="submit" name="enviar" value="Ingresar como usuario">
 </form>
 </div>


<?php require('footer.php'); ?>
