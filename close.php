<?php 
require('header.php');
session_start();
if(isset($_SESSION["usuarie"])){
	if($_GET["cerrar"]=="cerrar")
	{
		//echo "deseteando";
		unset($_SESSION["nombre"]);
		unset($_SESSION["usuarie"]);
		unset($_SESSION["pais"]);
		unset($_SESSION["email"]);
		session_destroy();
		//var_dump($_SESSION["nombre"]); echo "<br>";
		//var_dump($_SESSION["usuario"]); echo "<br>";
		//var_dump($_SESSION["pais"]); echo "<br>";
		//var_dump($_SESSION["email"]); echo "<br>";
		//echo "Sesión cerrada";
	}
}
?>

<div class="containerb">
	<section class="registration-landing">
		<img class="section-image" src="images/login.jpg" alt="Pagina de Login">
		<h1>Login</h1>
		<p>Comparti tus escritos🍕🔺🏳‍🌈👩‍💻💬☕</p>

		<div class="button-group">
			<a href="logusu.php" class="btn btn-warning">Entrar</a>
		</div>
	</section>
</div>

<?php require('footer.php'); ?>
