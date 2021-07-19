<?php	
	$usuarie = $_POST["nombreusu"];
	$pass = $_POST["pass"];
	$sesion = false;
	$usuarie_encontrado = false;
	
	//Lectura de archivo y chequeo de existencia previa de usuarie
	
	$json_previo = file_get_contents("usuaries.json"); //Tomo el contenido del JSON
	
	$previo = json_decode($json_previo, true); //Paso de JSON a array asociativo. Hay que ponerle true para que devuelva arrays asoc y no objetos
			
	//Agrego campo de array al array obtenido del json
	
	foreach($previo as $valor){
		if ($usuarie == $valor["usuarie"]){ //Si ya existe une usuarie con el nombre de usuarie ingresado
			echo "Usuarie encontrado<br>";
			$hash = $valor["hash"]; 
			if(password_verify($pass, $hash)){
				echo "Inicio de sesión<br>";
				$usuarie_encontrado = true;
				$sesion = true;
				session_start();
				$_SESSION["nombre"]=$valor["nombre"];
				$_SESSION["usuarie"]=$valor["usuarie"];
				$_SESSION["pais"]=$valor["pais"];
				$_SESSION["email"]=$valor["email"];
				$nombre = "Hola " . $_SESSION["usuarie"];
				echo $nombre;
				//var_dump($_SESSION["nombre"]); echo "<br>";
				//var_dump($_SESSION["usuaries"]); echo "<br>";
				//var_dump($_SESSION["pais"]); echo "<br>";
				//var_dump($_SESSION["email"]); echo "<br>";
			} else {
				echo "No coincide pass<br>";
				$usuarie_encontrado = true;
			}
			
		}
	}
	if($usuarie_encontrado == false){
		echo "No se encontró usuarie<br>";
	}
?>

<html>
	<form action="close.php">
	<input type="submit" name="cerrar" value="cerrar">
</html>