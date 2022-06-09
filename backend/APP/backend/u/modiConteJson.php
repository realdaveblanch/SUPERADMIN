<?php
	//CHECK DE LOGIN O REDIRIGIR AL LOGIN
    if(isset($_COOKIE['user_name'])){
		echo ''; 
	}
	else {
		//Si no tiene coockie me envia a "index,php"
		echo "<META http-equiv=".'"REFRESH"'." CONTENT=".'"0;URL=../index.php"'.">";	
		exit;
	}

	//Entra en el if cuando en "formu.php" elegimos alguna opcion de "opciones[]"
	if(isset($_POST["opciones"])){
		$cont=0;

		//Recorrecomos los "checkbox" que se han seleccionado de "formu.php"
		foreach($_POST["opciones"] as $opcion) {
			$cont++;

			//Guardamos la opcion que se ha escogido y le añadimos al final del string "-op1" porque en "formu.php" el nombre de <inmput> es "pregunta?-op1"
			$op = $opcion . "-op1";
			//Se guarda la pregunta del cliente
			$preguntaCliente = $_POST["$op"];

			//Guardamos la opcion que se ha escogido y le añadimos al final del string "-op2" porque en "formu.php" el nombre de <textarea> es "pregunta?-op2"
			$op2 = $opcion . "-op2";
			//Se guarda las opciones del cliente
			$opcionesCliente = $_POST["$op2"];

			//Si el usuario introduce algo en la pregunta de "formu.php" entrara en el if
			if($preguntaCliente != '') {

				//Cuando $cont sea igual a "1" entrara en el if
				if ($cont == 1 ) {
					//Limpiamos el contenido de "data.ini"
					file_put_contents('data.ini', '', LOCK_EX);
					clearstatcache();

					//Limpiamos el contenido de "preguntasActivas.ini"
					file_put_contents("preguntas/preguntasActivas.ini", '', LOCK_EX);
					clearstatcache();

					//Cuando "$i" es menor que 11 entrara en el if y repetira lo de dentro 10 veces
					//Si añadimos mas preguntas en "formu.php" tendremos que modificar el numero "11"
					for ($i=1; $i < 11 ; $i++) {
						//Limpiamos el contenido de "pregunta?.ini"
						file_put_contents("preguntas/pregunta$i.ini", '', LOCK_EX);
						//Limpiamos el contenido de "pregunta?.json"
						file_put_contents("../../assets/js/pregunta$i.json", '', LOCK_EX);
						clearstatcache();
					}	
				}

				//Limpiamos el contenido de "$opcion.ini" --> el nombre de "$opcion.ini" sera la escogida en el "checkbox"
				file_put_contents("preguntas/$opcion.ini", '', LOCK_EX);
				//Introduciomos en "$opcion.ini" el contenido de "$preguntaCliente"
				file_put_contents("preguntas/$opcion.ini", $preguntaCliente, FILE_APPEND | LOCK_EX);
				//Introduciomos en "preguntasActivas.ini" el contenido de "$preguntaCliente"
				file_put_contents("preguntas/preguntasActivas.ini", $preguntaCliente ."\r\n", FILE_APPEND | LOCK_EX);
				
				//Abrimos el fichero "data.ini" en modo escritura
				$fp = fopen('data.ini', 'a');
					//Este es el valor del "div" de "html" en "index.html" para mostrar la pregunta sexo
					//Están divididos para cargar entre medias el texto de la pregunta (variable $varsexo)
					$primera = '<div class="form-group">';	
					$ultima = '<select id="' . $opcion . '" class="form-control"></select></div>';
					$pregunta = file_get_contents("preguntas/$opcion.ini");

					//Escribiendo el div que muestra la pregunta al hacer el cuestionario
					fwrite($fp, $primera . "<label>" . $pregunta . "</label>" .  $ultima ."\r\n");
				fclose($fp);
			}

			//Si el usuario introduce algo en opciones de "formu.php" entrara en el if
			if($opcionesCliente != '') {
				//Dividimos los string de "$opcionesCliente" por ";" y lo guardamos en "$array"
				$array = explode(";", $opcionesCliente);
				//Cuenta todos los elementos de un array y lo guardamos en "$cadenaNum" 
				$cadenaNum = count($array); 
				$cont=0;

				//Limpiamos el contenido de "$opcion.json" --> el nombre de "$opcion.ini" sera la escogida en el "checkbox"
				file_put_contents("../../assets/js/$opcion.json", '', LOCK_EX);
				file_put_contents("../../assets/js/$opcion.json", "[{" . "\r\n", FILE_APPEND);

				//Recorremos "$array" y cogemos sus valores
				foreach ($array as $valor) {
					$cont++;

					file_put_contents("../../assets/js/$opcion.json", '"'."id".'"'.": ".'"'.$cont.'",' . "\r\n", FILE_APPEND);
					file_put_contents("../../assets/js/$opcion.json", '"'."value".'"'.":".'"'.$cont.'",' . "\r\n", FILE_APPEND);
					file_put_contents("../../assets/js/$opcion.json", '"'."nm".'"'.": ".'"'.$valor.'"' . "\r\n", FILE_APPEND);

					//cuando "$cont" sea igual que "$cadenaNum" entrara en el if
					if ($cont == $cadenaNum) {
						file_put_contents("../../assets/js/$opcion.json", "}]", FILE_APPEND);
				    	break;
					}

					file_put_contents("../../assets/js/$opcion.json", "},{" . "\r\n", FILE_APPEND);
				}	
			}	
		}
		//Redirige a "formu.php"
		echo "<META http-equiv=".'"REFRESH"'." CONTENT=".'"0;URL=formu.php"'.">";	
	}	
	else{
		//Si el usuario no selecciona ningun "checkbox" entrara en else 
		echo "No has seleccionado ninguna opcion. Por favor selecciona alguna";
		//Redirige a "formu.php" despues de 4 segundos
		echo "<META http-equiv=".'"REFRESH"'." CONTENT=".'"4;URL=formu.php"'.">";
	}

	$ua = $_SERVER['HTTP_USER_AGENT'];
	$id = sha1(rand(111111,999999));
	echo "<script> location.hash='user_token_id=$id&acc=administrator&&$ua';</script>";
?>