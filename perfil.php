<?php
//require('header.php');
session_start();
if(!isset($_SESSION["nombre"])){ //Si no se grabaron las variables de sesión aún
//Si viene del formulario de login y aun no se setearon las variables de sesión. Si viene de otro lado, como por ejemplo del botón "Mi perfil", es porque //la sesión está iniciada, y consiguientemente las variables de sesión seteadas. En tal caso, directamente va a la parte de sesión.

	$usuarie = $_POST["nombreusu"];
	$pass = $_POST["pass"];
	$sesion = false;
	$usuario_encontrado = false;
	$mensaje_ok = "";
	$mensaje_error = "";
	$tipo_usuario = $_POST["enviar"];
	$kind_of_user = "";
	//echo $tipo_usuario;

	//Lectura de archivo y chequeo de existencia previa de usuario

	if($tipo_usuario == "Ingreso de usuarie"){
		$json_previo = file_get_contents("usuaries.json"); //Tomo el contenido del JSON de usuarios
		$kind_of_user = "usuario";
		$_SESSION["kind_of_user"] = "usuarie";
	} else {$mensaje_error = $mensaje_error . "No se identificó usuarie <br>";}


	$previo = json_decode($json_previo, true); //Paso de JSON a array asociativo. Hay que ponerle true para que devuelva arrays asoc y no objetos

	//Agrego campo de array al array obtenido del json
	foreach($previo as $valor){
		if ($usuarie == $valor["usuarie"]){ //Si ya existe un usuario con el nombre de usuario ingresado
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
				
				//En el header se dibuja la barra de usuario (Hola, usuario -- Mi ConstruWorld) solo si están seteadas las variables de sesión.
				//Como cuando el usuario recién se loguea, las variables de sesión no están seteadas, hay que setear las variables y dibujar la barra
				/*echo "<ul class='menu-usuario'>
					<li class='dropdown-menu-usuario'>
						<a href='javascript:void(0)' class='dropbtn-menu-usuario'>Mi ConstruWorld</a>
						<div class='dropdown-content-mu'>
							<a class='submenu-mu' href='perfil.php'>Perfil</a>
							<a class='submenu-mu' href='log1.php?cerrar=cerrar'>Cerrar Sesi&oacuten</a>
						</div>
					<li class='dropdown-menu-usuario'><a class='submenu-mu' href='#home'>Hola, "; echo $_SESSION["nombre"]; echo "</a></li>
				</li>
				</ul>";*/
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
