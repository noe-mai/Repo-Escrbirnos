<?php
$paises = [
"00" => "",
"AR" => "Argentina",
"UY" => "Uruguay",
"BR" => "Brasil",
"PY" => "Paraguay",
"CH" => "Chile "
];
 ?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="styles.css">
    <title>Registro</title>
  </head>
  <body class="registro-body">
    <?php require('header.php'); ?>

    <p><h3 class="registro">Registrate acá 👽</h3></p>
<br>
<br>
<br>

<div class="form">
  <form class="" action="reg-usuarie.php" method="post" enctype="multipart/form-data">
    
      <p><input class="redondeadocolor" type="text" name="nombre" value="<?php isset($_POST['$nom']) ? $_POST['$nom'] : ' ';?>" placeholder="Nombre">
      <input class="redondeadocolor" type="text" name="apellido" value="<?php isset($_POST['$apel']) ? $_POST['$apel'] : ' ';?>" placeholder="Apellido"></p>
      <br>
      <br>
      <p><input class="redondeadocolor" type="text" name="nombreusu" value="<?php isset($_POST['$nombreusu']) ? $_POST['$nombreusu'] : ' ';?>" placeholder="Nombre de Usuarie"></p>
      <br>
       
      <p class="">Nacionalidad</p>
      <p><select class="redondeadocolor" type="text" name="pais" value="<?= $key ?>" <?php isset($_POST['$pais']) && $_POST['$pais'] == $key ? 'selected' : ''; ?>    placeholder="Elegí un país"></p>
          <?php foreach ($paises as $key => $pais) : ?>
            <?php if($_GET['paises'] == $key) : ?>
            <option value="<?=$key?>" selected><?=$pais?>
            </option>
          <?php else : ?>
            <option value="<?=$key?>"><?=$pais?>
            </option>
          <?php endif; ?>
          <?php endforeach; ?>
        </select>
      <br>
      <br>
      <p><input class="redondeadocolor" type="email" name="email" value="<?php isset($_POST['$email']) ? $_POST['$email'] : ' ';?>" placeholder="E-mail"></p>
      <br>
      <!--<p class="blanco">Elegí tu contraseña</p>-->
      <p><input class="redondeadocolor" type="password" name="password" value=""placeholder="Elegí tu contraseña "></p>
      <br>
      <!--<p class="blanco">Confirmá la contraseña, por favor</p>-->
      <p><input class="redondeadocolor" type="password" name="rePassword" value="" placeholder="Reconfirmá tu contraseña acá"></p>
      <br>
      <br>
	  <label for="archivo">Imagen de perfil (jpg): </label>
		<input type="file" name="archivo"><br>
      <input class="boton-registro"type="submit" name="enviar" value="Registrarme">
  </form>
  <br><br>
</div>
    <?php require('footer.php'); ?>

  </body>
</html>
