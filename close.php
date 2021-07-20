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

	}
}
?>

<div class="container">
	<section class="registration-landing">
		<img class="section-image" src="images/login.jpg" alt="Pagina de Login">
		<h1>Login</h1>
		<p>Comparti tus escritos🍕🔺🏳‍🌈👩‍💻💬☕</p>

		<div class="">
			<a href="login.php" class="">Entrar</a>
		</div>
	</section>
</div>

<?php require('footer.php'); ?>
