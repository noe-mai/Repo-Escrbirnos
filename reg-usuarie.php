<?php
	$valido = true;
	$usuarie_existe = false;
	$mensaje_ok = "";
	$mensaje_error = "";
	$reboto_pass = false;

	if (strlen($_POST["nombre"]) > 0){
		$mensaje_ok = $mensaje_ok . "Nombre ok <br>";
	} else {$mensaje_error = $mensaje_error . "No ingresó nombre 🙄 <br>"; $valido = false;}

	if (strlen($_POST["apellido"]) > 0){
		$mensaje_ok = $mensaje_ok . "Apellido ok <br>";
	} else {$mensaje_error = $mensaje_error . "No ingresó nombre 🙄 <br>"; $valido = false;}

	if (strlen($_POST["nombreusu"]) >= 4){
		$mensaje_ok = $mensaje_ok . "Usuarie ok <br>";
	} else {$mensaje_error = $mensaje_error . "Nombre usuarie debe tener al menos 4 caracteres <br>"; $valido = false;}


	if (strlen($_POST["pais"]) > 0){
		$mensaje_ok = $mensaje_ok . "País ok <br>";
	} else {$mensaje_error = $mensaje_error . "No ingresó país <br>"; $valido = false;}

	if (filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)){
		$mensaje_ok = $mensaje_ok . "Mail ok <br>";
	} else {$mensaje_error = $mensaje_error . "No ingresó formato de mail válido <br>"; $valido = false;}

	if (strlen($_POST["password"]) >= 5 && !preg_match('/\s/',$_POST["password"]) && preg_match('/ALT/',$_POST["password"])){
		$mensaje_ok = $mensaje_ok . "Pass ok <br>";
	} else {$mensaje_error = $mensaje_error . "Pass debe tener al menos 5 caracteres, no tener espacios y debe contener 'ALT' <br>";
			$valido = false;
			$reboto_pass = true;
	}

	if (strlen($_POST["rePassword"]) >= 5 && !preg_match('/\s/',$_POST["rePassword"]) && preg_match('/ALT/',$_POST["rePassword"])){
		$mensaje_ok = $mensaje_ok . "Pass2 ok <br>";
	} else {
			if($reboto_pass == false){ //Si rebotan pass y repetición de pass, sin esta variable muestra el mensaje dos veces
				$mensaje_error = $mensaje_error . "Pass debe tener al menos 5 caracteres, no tener espacios y debe contener 'ALT' <br>"; $valido = false;
			}
	}

	$nom = $_POST["nombre"];
	$apel = $_POST["apellido"];
	$nombre = $nom . " " . $apel;
	$usuarie = $_POST["nombreusu"];
	$pais = $_POST["pais"]; 
	$email = $_POST["email"];
	$pass = $_POST["password"];
	$pass2 = $_POST["rePassword"];

	if ($pass == $pass2){
		$hash = password_hash($pass, PASSWORD_DEFAULT);
		//var_dump($hash);
		//echo "Hash calculado<br>";
	} else { $mensaje_error = $mensaje_error . "Pass y confirmación de pass no coinciden"; $valido = false;}

	//Lectura de archivo y chequeo de existencia previa de usuarie

	$json_previo = file_get_contents("usuaries.json"); //Tomo el contenido del JSON

	if($json_previo){	
		$previo = json_decode($json_previo, true); 
	//Creación de array asociativo de usuariE
	if($valido){ //Si no falló ninguna de las validaciones del nuevo usuarie

		//Agrego campo de array al array obtenido del json

		$cant_campos = 0;

	if($json_previo){
		foreach($previo as $valor){

			if ($usuarie == $valor["usuarie"]){ //Si ya existe une usuarie con el nombre ingresado
				$usuarie_existe = true;
				$valido = false;
			}
			$cant_campos++;
		}
	}
		if($usuarie_existe == false){

			//Imagen de perfil
			if($_FILES["archivo"]["error"] === UPLOAD_ERR_OK){
				//echo "UPLOAD_ERR_OK";
				$nombre_ar = $_FILES["archivo"]["name"];
				$archivo = $_FILES["archivo"]["tmp_name"];
				$ext = pathinfo($nombre_ar, PATHINFO_EXTENSION);
				$miArchivo = dirname(__FILE__);
				$miArchivo = $miArchivo. "\\". "usuaries" . "\\" .$usuarie. ".".$ext; 
				//echo "miArchivo es: " . $miArchivo . "<br>";
				if($ext=="jpg" || $ext=="png"){
					move_uploaded_file($archivo, $miArchivo);
				} else {
					$mensaje_error = $mensaje_error . "Formato de imagen incorrecto<br>";
					$valido = false;
				}
			} else {
				$mensaje_error = $mensaje_error . "Error carga foto de perfil<br>";
				$valido = false;
			}

			//Fin  imagen de perfil

			if($valido){
				$campo_usuarie = [
					"nombre" => $nombre,
					"usuarie" => $usuarie,
					"pais" => $pais,
					"email" => $email,
					"hash" => $hash,
					"ext" => $ext
				];
				$previo[$cant_campos] = $campo_usuarie; //Agrego el nuevo usuarie al JSON
				$json = json_encode($previo); //Vuelvo a codificar a JSON
				file_put_contents("usuaries.json", $json); 
			}

		} else {
			$mensaje_error = $mensaje_error . "Ese usuarie ya existe<br>";
		}
	}
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="styles.css">
    <title>Registro</title>
  </head>
  <body class="">
    <?php require('header.php'); ?>

	<?php if($valido){
		echo "<p><h3 class='registro'>Usuarie registrade exitosamente</h3></p>";
		echo "<p><h3 class='registro'>Felicidades, "; echo($nombre); echo "</h3></p>";
	} else {
		echo "<p><h3 class='registro'> Error <br> "; echo($mensaje_error); echo "</h3></p>";
	}?>
  </body>
</html>
