<?php	
	$usuario = $_POST["nombreusu"];
	$pass = $_POST["pass"];
	$sesion = false;
	$usuario_encontrado = false;
	
	//Lectura de archivo y chequeo de existencia previa de usuario
	
	$json_previo = file_get_contents("usuaries.json"); //Tomo el contenido del JSON
	
	$previo = json_decode($json_previo, true); //Paso de JSON a array asociativo. Hay que ponerle true para que devuelva arrays asoc y no objetos
			
	//Agrego campo de array al array obtenido del json
	
	foreach($previo as $valor){
		if ($usuario == $valor["usuario"]){ //Si ya existe un usuario con el nombre de usuario ingresado
			echo "Usuario encontrado<br>";
			$hash = $valor["hash"]; //Levanto el hash para el usuario en cuestión del array que se levantó del JSON
			if(password_verify($pass, $hash)){
				echo "Inicio de sesión<br>";
				$usuario_encontrado = true;
				$sesion = true;
				session_start();
				$_SESSION["nombre"]=$valor["nombre"];
				$_SESSION["usuario"]=$valor["usuario"];
				$_SESSION["pais"]=$valor["pais"];
				$_SESSION["email"]=$valor["email"];
				$nombre = "Hola " . $_SESSION["usuario"];
				echo $nombre;
				//var_dump($_SESSION["nombre"]); echo "<br>";
				//var_dump($_SESSION["usuario"]); echo "<br>";
				//var_dump($_SESSION["pais"]); echo "<br>";
				//var_dump($_SESSION["email"]); echo "<br>";
			} else {
				echo "No coincide pass<br>";
				$usuario_encontrado = true;
			}
			break;
		}
	}
	if($usuario_encontrado == false){
		echo "No se encontró usuario<br>";
	}
?>

<html>
	<form action="cerrses.php">
	<input type="submit" name="cerrar" value="cerrar">
</html>