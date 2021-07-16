<?php

require('header.php');

session_start();
if(!isset($_SESSION["nombre"])){ 

	$usuarie = $_POST["nombreusu"];
	$pass = $_POST["pass"];
	$sesion = false;
	$usuarie_encontrado = false;
	$mensaje_ok = "";
	$mensaje_error = "";
	$tipo_usuarie = $_POST["enviar"];
	$kind_of_user = "";
	

	if($tipo_usuarie == "Ingreso de usuarie")
	{
		$json_previo = file_get_contents("usuaries.json"); //Tomo el contenido del JSON de usuaries
		$kind_of_user = "usuarie";
		$_SESSION["kind_of_user"] = "usuarie";
	} 
	
	else {$mensaje_error = $mensaje_error . "No se identificó usuarie <br>";}


	$previo = json_decode($json_previo, true); 

	foreach($previo as $valor){
		if ($usuarie == $valor["usuarie"]){ //Si ya existe un usuarie con el nombre de usuarie ingresado
			$mensaje_ok = $mensaje_ok . "Usuarie encontrado<br>";
			$hash = $valor["hash"]; 
			if(password_verify($pass, $hash)){
				$mensaje_ok = $mensaje_ok . "Inicio de sesión<br>";
				$usuarie_encontrado = true;
				$sesion = true;
				//session_start();
				$_SESSION["nombre"]=$valor["nombre"];
				$_SESSION["usuarie"]=$valor["usuarie"];
				$_SESSION["pais"]=$valor["pais"];
				$_SESSION["email"]=$valor["email"];
				$_SESSION["ext"]=$valor["ext"]; 
				$_SESSION["kind_of_user"] = $kind_of_user;
				$nombre = "Hola " . $_SESSION["nombre"];

			} else {
				$mensaje_error = $mensaje_error . "No coincide pass<br>";
				$usuarie_encontrado = true;
			}
			break;
		}
	}
	if($usuarie_encontrado == false){
		$mensaje_error = $mensaje_error . "No se encontró usuarie😓<br>";
	}
} 

else {$sesion = true;} 
						
if($sesion){
	require('header.php');

		 $extension = $_SESSION["ext"];
		 $imagenUsuarie = $_SESSION["usuarie"].".".$extension;
	

		echo "<div class='main-profile'>";
			if ($_SESSION["kind_of_user"] == "usuarie"/*$kind_of_user == "usuarie"*/){
				echo "<img class='profile-picture' height='200px' src='usuaries/"; echo $imagenUsuarie; echo "' alt='Usuarie'>";
			
			}
			echo "<h2 style='text-align:center;'>"; echo($_SESSION["nombre"]); echo "</h2>";
			"<h3 style='text-align:center;'>";
			echo ($_SESSION["nombre"]); echo "<br>";
			echo ($_SESSION["usuarie"]); echo "<br>";
			echo ($_SESSION["pais"]); echo "<br>";
			echo ($_SESSION["email"]); echo "<br>";

		require('header.php');
		echo "<body class='registro-body'>

		<p><h3 class='registro'>"; echo($mensaje_error); echo "</h3></p>";
	
  }

<?php require('footer.php'); ?>
