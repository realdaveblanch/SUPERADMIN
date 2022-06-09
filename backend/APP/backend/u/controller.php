<?php
	//CHECK DE LOGIN O REDIRIGIR AL LOGIN
    if(isset($_COOKIE['user_name'])){
		echo ''; 
	}
	else {
		echo "<META http-equiv=".'"REFRESH"'." CONTENT=".'"0;URL=../index.php"'.">";	
		exit;
	}

	//Primero elimina los valores dentro de data.ini para evitar duplicar preguntas
	if (is_file("data.ini")) {
		file_put_contents('data.ini','');
		clearstatcache();
	}

	//Cuando le demos al boton "enviar" que esta en "formu.php" entrara en el if
	if(isset($_POST['sexoText'])) {
		//Guardo el valor introducido por el usuario en la variable "$data"
		$data = $_POST['sexoText'];
			//Abro el fichero "sexoText.ini" en modo escritura
			$fp = fopen('sexoText.ini', 'a');
				//Sobreescribe el contenido que tuviese en el fichero "sexoText.ini" y le pone "nada" para que el fichero quede vacio
				file_put_contents('sexoText.ini','', LOCK_EX);
				//Escribimos en el fichero "sexoText.ini" lo que introdujo el usuario
				fwrite($fp, $data);
		fclose($fp);
	}
		//Si el valor del formulario es sexo:
	if(isset($_POST['sexo'])) {
		//Toma el valor sexo
		$data = $_POST['sexo'].PHP_EOL;
		//abre el archivo data.ini,
		$fp = fopen('data.ini', 'a');
			//este es el valor del div html en index.html para mostrar la pregunta sexo
			//Están divididos para cargar entre medias el texto de la pregunta (variable $varsexo)
			$primera = '<div class="form-group">';
			$ultima = '<select  id="sexo" class="form-control"></select></div>';
			$varsexo = file_get_contents('sexoText.ini'); 
			//escribiendo el div que muestra la pregunta al hacer el cuestionario
			fwrite($fp, $primera . "<label>" . $varsexo . "</label>" .  $ultima);
		fclose($fp);
	}
	
	//Cuando le demos al boton "enviar" que esta en "formu.php" entrara en el if
	if(isset($_POST['provinciaText'])) {
		//Guardo el valor introducido por el usuario en la variable "$data"
		$data = $_POST['provinciaText'];
		//Abro el fichero "provinciaText.ini" en modo escritura
		$fp = fopen('provinciaText.ini', 'a');
			//Sobreescribe el contenido que tuviese en el fichero "provinciaText.ini" y le pone "nada" para que el fichero quede vacio
			file_put_contents('provinciaText.ini','', LOCK_EX);
			//Escribimos en el fichero "provinciaText.ini" lo que introdujo el usuario
			fwrite($fp, $data);
		fclose($fp);
	}
	
	//Si el valor del formulario es provincia:
	if(isset($_POST['provincia'])) {
		//Toma el valor provincia
		$data=$_POST['provincia'].PHP_EOL;
		//abre el archivo data.ini,
		$fp = fopen('data.ini', 'a');
			//este es el valor del div html en index.html para mostrar la pregunta provincia
			//Están divididos para cargar entre medias el texto de la pregunta (variable $varprovincia)
			$primera = '<div class="form-group">';
			$ultima = '<select  id="provincia" class="form-control"></select></div>';
			$varprovincia = file_get_contents('provinciaText.ini');
			//escribiendo el div que muestra la pregunta al hacer el cuestionario
			fwrite($fp, $primera . "<label>" . $varprovincia . "</label>" .  $ultima);
		fclose($fp);
	}
	
		//Cuando le demos al boton "enviar" que esta en "formu.php" entrara en el if
	if(isset($_POST['edadText'])) {
		//Guardo el valor introducido por el usuario en la variable "$data"
		$data = $_POST['edadText'];
		//Abro el fichero "edadText.ini" en modo escritura
		$fp = fopen('edadText.ini', 'a');
			//Sobreescribe el contenido que tuviese en el fichero "edadText.ini" y le pone "nada" para que el fichero quede vacio
			file_put_contents('edadText.ini','', LOCK_EX);
			//Escribimos en el fichero "edadText.ini" lo que introdujo el usuario
			fwrite($fp, $data);
		fclose($fp);
	}
	
	//Si el valor del formulario es edad:
	if(isset($_POST['edad'])) {
		//Toma el valor edad
		$data=$_POST['edad'].PHP_EOL;
		//abre el archivo data.ini,
		$fp = fopen('data.ini', 'a');
			//este es el valor del div html en index.html para mostrar la pregunta edad
			//Están divididos para cargar entre medias el texto de la pregunta (variable $varedad)
			$primera = '<div class="form-group">';
			$ultima = '<select  id="edad" class="form-control"></select></div>';
			$varedad = file_get_contents('edadText.ini');
			//escribiendo el div que muestra la pregunta al hacer el cuestionario
			fwrite($fp, $primera . "<label>" . $varedad . "</label>" .  $ultima);
		fclose($fp);
	}
	
	//Cuando le demos al boton "enviar" que esta en "formu.php" entrara en el if
	if(isset($_POST['empresaText'])) {
		//Guardo el valor introducido por el usuario en la variable "$data"
		$data = $_POST['empresaText'];
		//Abro el fichero "empresaText.ini" en modo escritura
		$fp = fopen('empresaText.ini', 'a');
			//Sobreescribe el contenido que tuviese en el fichero "empresaText.ini" y le pone "nada" para que el fichero quede vacio
			file_put_contents('empresaText.ini','', LOCK_EX);
			//Escribimos en el fichero "empresaText.ini" lo que introdujo el usuario
			fwrite($fp, $data);
		fclose($fp);
	}
											
	//Si el valor del formulario es empresa:
	if(isset($_POST['empresa'])) {
		//Toma el valor empresa
		$data=$_POST['empresa'].PHP_EOL;
		//abre el archivo data.ini,
		$fp = fopen('data.ini', 'a');
			//este es el valor del div html en index.html para mostrar la pregunta empresa
			//Están divididos para cargar entre medias el texto de la pregunta (variable $varempresa)
			$primera = '<div class="form-group">';
			$ultima = '<select  id="empresa" class="form-control"></select></div>';
			$varempresa = file_get_contents('empresaText.ini');
			//escribiendo el div que muestra la pregunta al hacer el cuestionario
			fwrite($fp, $primera . "<label>" . $varempresa . "</label>" .  $ultima);
		fclose($fp);
	}
	
	//Cuando le demos al boton "enviar" que esta en "formu.php" entrara en el if
	if(isset($_POST['antiguedadText'])) {
		//Guardo el valor introducido por el usuario en la variable "$data"
		$data = $_POST['antiguedadText'];
		//Abro el fichero "antiguedadText.ini" en modo escritura
		$fp = fopen('antiguedadText.ini', 'a');
			//Sobreescribe el contenido que tuviese en el fichero "antiguedadText.ini" y le pone "nada" para que el fichero quede vacio
			file_put_contents('antiguedadText.ini','', LOCK_EX);
			//Escribimos en el fichero "antiguedadText.ini" lo que introdujo el usuario
			fwrite($fp, $data);
		fclose($fp);
	}
	
	//Si el valor del formulario es antiguedad:
	if(isset($_POST['antiguedad'])) {
		//Toma el valor antiguedad
		$data=$_POST['antiguedad'].PHP_EOL;
		//abre el archivo data.ini,
		$fp = fopen('data.ini', 'a');
			//este es el valor del div html en index.html para mostrar la pregunta antiguedad
			//Están divididos para cargar entre medias el texto de la pregunta (variable $varantiguedad)
			$primera = '<div class="form-group">';
			$ultima = '<select  id="tiempo" class="form-control"></select></div>';
			$varantiguedad = file_get_contents('antiguedadText.ini');
			//escribiendo el div que muestra la pregunta al hacer el cuestionario
			fwrite($fp, $primera . "<label>" . $varantiguedad . "</label>" .  $ultima);
		fclose($fp);
	}
	
	//Cuando le demos al boton "enviar" que esta en "formu.php" entrara en el if
	if(isset($_POST['jornadaText'])) {
		//Guardo el valor introducido por el usuario en la variable "$data"
		$data = $_POST['jornadaText'];
		//Abro el fichero "jornadaText.ini" en modo escritura
		$fp = fopen('jornadaText.ini', 'a');
			//Sobreescribe el contenido que tuviese en el fichero "jornadaText.ini" y le pone "nada" para que el fichero quede vacio
			file_put_contents('jornadaText.ini','', LOCK_EX);
			//Escribimos en el fichero "jornadaText.ini" lo que introdujo el usuario
			fwrite($fp, $data);
		fclose($fp);
	}
	
	//Si el valor del formulario es jornada:
	if(isset($_POST['jornada'])) {
		//Toma el valor jornada
		$data=$_POST['jornada'].PHP_EOL;
		//abre el archivo data.ini,
		$fp = fopen('data.ini', 'a');
			//este es el valor del div html en index.html para mostrar la pregunta jornada
			//Están divididos para cargar entre medias el texto de la pregunta (variable $varjornada)
			$primera = '<div class="form-group">';
			$ultima = '<select  id="jornada" class="form-control"></select></div>';
			$varjornada = file_get_contents('jornadaText.ini');
			//escribiendo el div que muestra la pregunta al hacer el cuestionario
			fwrite($fp, $primera . "<label>" . $varjornada . "</label>" .  $ultima);
		fclose($fp);
	}	
	
	//Cuando le demos al boton "enviar" que esta en "formu.php" entrara en el if
	if(isset($_POST['trabajoText'])) {
		//Guardo el valor introducido por el usuario en la variable "$data"
		$data = $_POST['trabajoText'];
		//Abro el fichero "trabajoText.ini" en modo escritura
		$fp = fopen('trabajoText.ini', 'a');
			//Sobreescribe el contenido que tuviese en el fichero "trabajoText.ini" y le pone "nada" para que el fichero quede vacio
			file_put_contents('trabajoText.ini','', LOCK_EX);
			//Escribimos en el fichero "trabajoText.ini" lo que introdujo el usuario
			fwrite($fp, $data);
		fclose($fp);
	}
	
	//Si el valor del formulario es trabajo:
	if(isset($_POST['trabajo'])) {
		//Toma el valor trabajo
		$data=$_POST['trabajo'].PHP_EOL;
		//abre el archivo data.ini,
		$fp = fopen('data.ini', 'a');
			//este es el valor del div html en index.html para mostrar la pregunta trabajo
			//Están divididos para cargar entre medias el texto de la pregunta (variable $vartrabajo)
			$primera = '<div class="form-group">';
			$ultima = '<select  id="puesto" class="form-control"></select></div>';
			$vartrabajo = file_get_contents('trabajoText.ini');
			//escribiendo el div que muestra la pregunta al hacer el cuestionario
			fwrite($fp, $primera . "<label>" . $vartrabajo . "</label>" .  $ultima);
		fclose($fp);
	}

	
	


	//Cuando le demos al boton "enviar" que esta en "formu.php" entrara en el if
	if(isset($_POST['departamentoText'])) {
		//Guardo el valor introducido por el usuario en la variable "$data"
		$data = $_POST['departamentoText'];
		//Abro el fichero "departamentoText.ini" en modo escritura
			$fp = fopen('departamentoText.ini', 'a');
				//Sobreescribe el contenido que tuviese en el fichero "departamentoText.ini" y le pone "nada" para que el fichero quede vacio
				file_put_contents('departamentoText.ini','', LOCK_EX);
				//Escribimos en el fichero "departamentoText.ini" lo que introdujo el usuario
				fwrite($fp, $data);
		fclose($fp);
	}
	
	//Si el valor del formulario es departamento:
	if(isset($_POST['departamento'])) {
		//Toma el valor departamento
		$data=$_POST['departamento'].PHP_EOL;
		//abre el archivo data.ini,
		$fp = fopen('data.ini', 'a');
			//este es el valor del div html en index.html para mostrar la pregunta departamento
			//Están divididos para cargar entre medias el texto de la pregunta (variable $vardepartamento)
			$primera = '<div class="form-group">';
			$ultima = '<select  id="area" class="form-control"></select></div>';
			$vardepartamento = file_get_contents('departamentoText.ini');
			//escribiendo el div que muestra la pregunta al hacer el cuestionario
			fwrite($fp, $primera . "<label>" . $vardepartamento . "</label>" .  $ultima);
		fclose($fp);
	}

	//AQUÍ DEBAJO DEBES PEGAR EL CÓDIGO 
	
	
	
	
	
	
	
	//FIN DE CÓDIGO NUEVO PREGUNTAS
																		
								$ua = $_SERVER['HTTP_USER_AGENT'];
								$id = sha1(rand(111111,999999));
								echo "<script> location.hash='user_token_id=$id&acc=administrator&&$ua';</script>";
			
				//CODE BY
	//https://github.com/realdaveblanch
		//https://github.com/X-aaron-X
?>