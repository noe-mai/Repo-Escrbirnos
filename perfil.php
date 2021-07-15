<?php
//require('header.php');
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
	//echo $tipo_usuario;

	//Lectura de archivo y chequeo de existencia previa de usuario

	if($tipo_usuarie == "Ingreso de usuarie"){
		$json_previo = file_get_contents("usuaries.json"); //Tomo el contenido del JSON de usuaries
		$kind_of_user = "usuarie";
		$_SESSION["kind_of_user"] = "usuarie";
	} else {$mensaje_error = $mensaje_error . "No se identificó usuarie <br>";}


	$previo = json_decode($json_previo, true); 

	foreach($previo as $valor){
		if ($usuarie == $valor["usuarie"]){ //Si ya existe un usuarie con el nombre de usuario ingresado
			$mensaje_ok = $mensaje_ok . "Usuarie encontrado<br>";
			$hash = $valor["hash"]; //Levanto el hash para le usuarie en cuestión del array que se levantó del JSON
			if(password_verify($pass, $hash)){
				$mensaje_ok = $mensaje_ok . "Inicio de sesión<br>";
				$usuarie_encontrado = true;
				$sesion = true;
				//session_start();
				$_SESSION["nombre"]=$valor["nombre"];
				$_SESSION["usuarie"]=$valor["usuarie"];
				$_SESSION["pais"]=$valor["pais"];
				$_SESSION["email"]=$valor["email"];
				$_SESSION["ext"]=$valor["ext"]; //Se agregó la extensión de la foto al json 1-7-19
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
} else {$sesion = true;} //Si entra en else es porque están seteadas las variables de sesión (a juzgar por $_SESSION["nombre"]). Entonces setea $sesion
						//para que entre en la parte que "dibuja" el perfil de usuario -if($sesion)-.

if($sesion){
	require('header.php');

		 $extension = $_SESSION["ext"];
		 $imagenUsuarie = $_SESSION["usuarie"].".".$extension;
			//echo $imagenUsuario;

		echo "<div class='main-profile'>
			<br>";
			if ($_SESSION["kind_of_user"] == "usuarie"/*$kind_of_user == "usuario"*/){
				echo "<img class='profile-picture' height='200px' src='usuarios/"; echo $imagenUsuarie; echo "' alt='Usuario'>";
			} else if ($_SESSION["kind_of_user"] == "prestador"/*$kind_of_user == "prestador"*/){
				echo "<img class='profile-picture' height='200px' src='prestadores/"; echo $imagenUsuario; echo "' alt='Prestador'>";
			}
			echo "<h2 style='text-align:center;'>"; echo($_SESSION["nombre"]); echo "</h2>
			<h3 style='text-align:center;'>";
			echo ($_SESSION["nombre"]); echo "<br>";
			echo ($_SESSION["usuarie"]); echo "<br>";
			echo ($_SESSION["pais"]); echo "<br>";
			echo ($_SESSION["email"]); echo "<br>";

		</div>
	</div>
	</div>";
} else {
		require('header2.php');
		echo "<body class='registro-body'>
		<br>
		<br>
		<p><h3 class='registro'>"; echo($mensaje_error); echo "</h3></p>";
	
  }
?>

<?php require('footer.php'); ?>
