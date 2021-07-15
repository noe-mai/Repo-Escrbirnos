php require('header.php'); ?>

<div>
  <a href="contacto.php">Contacto</a><br>
  <form method="post" action="formulario.php" >
    <p>
    <br><label for="nombre">Nombre: </label>
    <input id="nombre" type="text" name="nombre">
    </p>
    <p>
    <label for="">E - mail : </label>
    <input id="email" type="text" name="email">
    </p>
    <p>
    <label for="">Mensaje: </label>
    <input id="mensaje" type="text" name="mensaje">
    </p>
    <p>
    <input id="enviar" type="submit" value="Enviar">
    </p>
  </form>
</div>
<br><br>
<footer class="page-footer">

 </footer>
</body>
</html>
