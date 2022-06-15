<?php
	//CHECK DE LOGIN O REDIRIGIR AL LOGIN
    if(isset($_COOKIE['user_name'])) {
		echo ''; 
	}
	else {
		echo "<META http-equiv=".'"REFRESH"'." CONTENT=".'"0;URL=../index.php"'.">";	
		exit;
	}
?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <meta content="width=device-width, initial-scale=1" name="viewport" />
        <title>ADMIN PANEL <?php echo file_get_contents('cfg/hostname.ini'); ?></title>
        <!-- CSS -->
        <link rel="stylesheet" href="../../assets/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="../../assets/fonts/font-awesome/css/font-awesome.min.css">
        <link rel="stylesheet" href="../../assets/css/style.css">
		<link rel="stylesheet" href="../../assets/css/style2.css">
		<link rel="stylesheet" href="../../assets/css/sidemenu.css">
        <link rel="icon"  href="../../assets/img/favi.png">
		<link rel='stylesheet' href='https://fonts.googleapis.com/icon?family=Material+Icons'>
		<link rel="stylesheet" href="../../assets/css/banner.css">
		<link rel="stylesheet" href="../../assets/css/bannerset.css">
		<?php
	

		$ua = $_SERVER['HTTP_USER_AGENT'];

		$id = sha1(rand(111111,999999));
		echo "<script> location.hash='user_token_id=$id&acc=administrator&&$ua';</script>";
		?>			
    </head>
    <body>
        <!-- Top content -->
        <div class="divText">
	        <div class="blanco top-content">
				<div class=" logos">
	                <img src="../../assets/img/Ibersys.jpg" alt="">
					<img src="../../assets/img/logo.png" alt="">
				</div>
				<div id="mySidenav" class="sidenav">
						<a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
						<a href="ad.php">ADMIN PANEL</a>
						<a href="formu.php">MODIFICAR CUESTIONARIO</a>
						<a href="logo.php">SUBIR LOGO CLIENTE</a>
						<a href="usupass.php">CAMBIAR CONTRASEÑA</a>
						<a href="../../readme/INSTRUCCIONES-APP-ADMIN.pdf">AYUDA</a>
						<a href="logout.php">CERRAR SESIÓN</a>
					</div>
				<span style="font-size:30px;cursor:pointer" onclick="openNav()">&#9776; Menú</span>
				<! -- banner del admin -->
							<div class="container">
								<div class="rectangle" style="margin-left: -56px;">
									<div class="notification-text">
										<i class="material-icons">info</i>
										<span>&nbsp;&nbsp;Panel de <?php echo file_get_contents('cfg/hostname.ini'); ?>
										
					</span>
									</div>
								</div>
							</div>		
				<! -- FIN banner del admin -->
				<div class="contText">
					<div class="form-box">
						<h1 style="text-align: center;margin-top: 3px;">Preguntas y opciones del cuestionario</h1><br/>
						<button class="atrasIzq btn btn-grey btnInit" onclick ="location.href='ad.php'">Atrás</button>
						<div style="text-align: center;width: 29%;margin: 0 auto;">
							<?php
								echo "<table border='2'>";
									echo "<tr><th>Preguntas activas del cuestionario</th></tr>";
									$preguntas = fopen("preguntas/preguntasActivas.ini", "r");
										while(!feof($preguntas)) {
											$pregunta = fgets($preguntas);

											if($pregunta != "") {
												echo "<tr><td>$pregunta</td></tr>";
											}			
										}	
									fclose($preguntas);
	                            echo "</table>";
							?>
						</div>
						<br/>
						<form method="post" action="modiConteJson.php">
							<div class="divPreguntas">
								<div style="margin-left: 10%;">	
									<div>
										<label>Pregunta 1:</label><br/>
										<label>Introduce la pregunta y las opciones separadas por "punto y coma".</label><br/>
										<div class="abajoPregunta">
											<input type="checkbox" name="opciones[]" value="pregunta1">
											<label>ACTIVAR</label>
											<input type="text" autocomplete="off" name="pregunta1-op1" placeholder="<?php
												//Si el fichero "pregunta1.ini" esta vacio entrara en l if
												if (filesize('preguntas/pregunta1.ini') == 0) {
											 		echo "Introduce aquí la pregunta \r\n";
											 	}
											 	else{
											 		//Muestra el contenido de "pregunta1.ini"
											 		echo file_get_contents('preguntas/pregunta1.ini');
											 	}
											?>"
											/><br/><br/>
											<textarea name="pregunta1-op2" rows="2" placeholder ="<?php
											 	//Guardamos el valor "3" porque en "pregunta1.json" la línea que queremos leer es "nm"
											 	$valor = 3;
											 	//Guardamos el fichero "pregunta1.json" completo en un array
											 	//Ademas omitimos la nueva línea al final de cada elemento del array
											 	//Y nos saltamos las líneas vacías
											 	$lineas = file('../../assets/js/pregunta1.json', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

											 	//Si el fichero "pregunta1.json" esta vacio entrara en l if
											 	if (filesize('../../assets/js/pregunta1.json') == 0) {
											 		echo "Separa las opciones a introducir por punto y coma ';' por ejemplo: \r\n";
											 		echo "ejemplo1";
											 		goto end;
											 	}

											 	//Recorremos "$lineas"
											 	foreach ($lineas as $numLinea => $linea) {
											 		//Si "$numLinea" es igual a "$valor" entrara en el if
											 		if($numLinea == $valor) {
											 			//Convertimos los caracteres especiales en entidades HTML y los pintamos
											 			//por pantalla apartir del caracter "15" 
											 			echo  substr(htmlspecialchars($linea), 15);
											 			//Sumamos "4" a "$valor" porque la línea que queremos leer es "nm"
											 			$valor = $valor + 4;
											 		}	
												}
													end:
											 	?>"
											 ></textarea><br/><br/>
										</div>
									</div>
									
									<div>
										<label>Pregunta 2:</label><br/>
										<label>Introduce la pregunta y las opciones separadas por "punto y coma".</label><br/>
										<div class="abajoPregunta">
											<input type="checkbox" name="opciones[]" value="pregunta2">
											<label>ACTIVAR</label>
											<input type="text" autocomplete="off" name="pregunta2-op1" placeholder="<?php
												if (filesize('preguntas/pregunta2.ini') == 0) {
											 		echo "Introduce aquí la pregunta \r\n";
											 	}
											 	else{
											 		echo file_get_contents('preguntas/pregunta2.ini');
											 	}
											?>"
											/><br/><br/>
											<textarea name="pregunta2-op2" rows="2" placeholder ="<?php
											 	$valor = 3;
											 	$lineas = file('../../assets/js/pregunta2.json', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

											 	if (filesize('../../assets/js/pregunta2.json') == 0) {
											 		echo "Separa las opciones a introducir por punto y coma ';' por ejemplo: \r\n";
											 		echo "ejemplo1;ejemplo2";
											 		goto end2;
											 	}

											 	foreach ($lineas as $numLinea => $linea) {
											 		if($numLinea == $valor) {
											 			echo  substr(htmlspecialchars($linea), 15);
											 			$valor = $valor + 4;
											 		}	
												}
													end2:
											 	?>"
											 ></textarea><br/><br/>
										</div>
									</div>
									
									<div>
										<label>Pregunta 3:</label><br/>
										<label>Introduce la pregunta y las opciones separadas por "punto y coma".</label><br/>
										<div class="abajoPregunta">
											<input type="checkbox" name="opciones[]" value="pregunta3">
											<label>ACTIVAR</label>
											<input type="text" autocomplete="off" name="pregunta3-op1" placeholder="<?php
												if (filesize('preguntas/pregunta3.ini') == 0) {
											 		echo "Introduce aquí la pregunta \r\n";
											 	}
											 	else{
											 		echo file_get_contents('preguntas/pregunta3.ini');
											 	}
											?>"
											/><br/><br/>
											<textarea name="pregunta3-op2" rows="2" placeholder ="<?php
												$valor = 3;
											 	$lineas = file('../../assets/js/pregunta3.json', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

											 	if (filesize('../../assets/js/pregunta3.json') == 0) {
											 		echo "Separa las opciones a introducir por punto y coma ';' por ejemplo: \r\n";
											 		echo "ejemplo1;ejemplo2;ejemplo3";
											 		goto end3;
											 	}

											 	foreach ($lineas as $numLinea => $linea) {
											 		if($numLinea == $valor) {
											 			echo  substr(htmlspecialchars($linea), 15);
											 			$valor = $valor + 4;
											 		}	
												}	
													end3:
											 	?>"
											 ></textarea><br/><br/>
										</div>
									</div>

									<div>
										<label>Pregunta 4:</label><br/>
										<label>Introduce la pregunta y las opciones separadas por "punto y coma".</label><br/>
										<div class="abajoPregunta">
											<input type="checkbox" name="opciones[]" value="pregunta4">
											<label>ACTIVAR</label>
											<input type="text" autocomplete="off" name="pregunta4-op1" placeholder="<?php
												if (filesize('preguntas/pregunta4.ini') == 0) {
											 		echo "Introduce aquí la pregunta \r\n";
											 	}
											 	else{
											 		echo file_get_contents('preguntas/pregunta4.ini');
											 	}
											?>"
											/><br/><br/>
											<textarea name="pregunta4-op2" rows="2" placeholder ="<?php
											 	$valor = 3;
											 	$lineas = file('../../assets/js/pregunta4.json', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

											 	if (filesize('../../assets/js/pregunta4.json') == 0) {
											 		echo "Separa las opciones a introducir por punto y coma ';' por ejemplo: \r\n";
											 		echo "ejemplo1;ejemplo2;ejemplo3;ejemplo4";
											 		goto end4;
											 	}

											 	foreach ($lineas as $numLinea => $linea) {
											 		if($numLinea == $valor) {
											 			echo  substr(htmlspecialchars($linea), 15);
											 			$valor = $valor + 4;
											 		}
												}
													end4:	
											 	?>"
											></textarea><br/><br/>
										</div>
									</div>
									
									<div>
										<label>Pregunta 5:</label><br/>
										<label>Introduce la pregunta y las opciones separadas por "punto y coma".</label><br/>
										<div class="abajoPregunta">
											<input type="checkbox" name="opciones[]" value="pregunta5">
											<label>ACTIVAR</label>
											<input type="text" autocomplete="off" name="pregunta5-op1" placeholder="<?php
												if (filesize('preguntas/pregunta5.ini') == 0) {
											 		echo "Introduce aquí la pregunta \r\n";
											 	}
											 	else{
											 		echo file_get_contents('preguntas/pregunta5.ini');
											 	}
											?>"
											/><br/><br/>
											<textarea name="pregunta5-op2" rows="2" placeholder ="<?php
											 	$valor = 3;
											 	$lineas = file('../../assets/js/pregunta5.json', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

											 	if (filesize('../../assets/js/pregunta5.json') == 0) {
											 		echo "Separa las opciones a introducir por punto y coma ';' por ejemplo: \r\n";
											 		echo "ejemplo1;ejemplo2;ejemplo3;ejemplo4;ejemplo5";
											 		goto end5;
											 	}

											 	foreach ($lineas as $numLinea => $linea) {
											 		if($numLinea == $valor) {
											 			echo  substr(htmlspecialchars($linea), 15);
											 			$valor = $valor + 4;
											 		}	
												}
													end5:
											 	?>"
											></textarea><br/><br/>
										</div>
									</div>
									
									<div>
										<label>Pregunta 6:</label><br/>
										<label>Introduce la pregunta y las opciones separadas por "punto y coma".</label><br/>
										<div class="abajoPregunta">
											<input type="checkbox" name="opciones[]" value="pregunta6">
											<label>ACTIVAR</label>
											<input type="text" autocomplete="off" name="pregunta6-op1" placeholder="<?php
												if (filesize('preguntas/pregunta6.ini') == 0) {
											 		echo "Introduce aquí la pregunta \r\n";
											 	}
											 	else{
											 		echo file_get_contents('preguntas/pregunta6.ini');
											 	}
											?>"
											/><br/><br/>
											<textarea name="pregunta6-op2" rows="2" placeholder ="<?php
											 	$valor = 3;
											 	$lineas = file('../../assets/js/pregunta6.json', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

											 	if (filesize('../../assets/js/pregunta6.json') == 0) {
											 		echo "Separa las opciones a introducir por punto y coma ';' por ejemplo: \r\n";
											 		echo "ejemplo1;ejemplo2;ejemplo3;ejemplo4;ejemplo5;ejemplo6";
											 		goto end6;
											 	}

											 	foreach ($lineas as $numLinea => $linea) {
											 		if($numLinea == $valor) {
											 			echo  substr(htmlspecialchars($linea), 15);
											 			$valor = $valor + 4;
											 		}	
												}
													end6:
											 	?>"
											></textarea><br/><br/>
										</div>
									</div>

									<div>
										<label>Pregunta 7:</label><br/>
										<label>Introduce la pregunta y las opciones separadas por "punto y coma".</label><br/>
										<div class="abajoPregunta">
											<input type="checkbox" name="opciones[]" value="pregunta7">	
											<label>ACTIVAR</label>
											<input type="text" autocomplete="off" name="pregunta7-op1" placeholder="<?php
												if (filesize('preguntas/pregunta7.ini') == 0) {
											 		echo "Introduce aquí la pregunta \r\n";
											 	}
											 	else{
											 		echo file_get_contents('preguntas/pregunta7.ini');
											 	}
											?>"
											/><br/><br/>
											<textarea name="pregunta7-op2" rows="2" placeholder ="<?php
											 	$valor = 3;
											 	$lineas = file('../../assets/js/pregunta7.json', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

											 	if (filesize('../../assets/js/pregunta7.json') == 0) {
											 		echo "Separa las opciones a introducir por punto y coma ';' por ejemplo: \r\n";
											 		echo "ejemplo1;ejemplo2;ejemplo3;ejemplo4;ejemplo5;ejemplo6;ejemplo7";
											 		goto end7;
											 	}

											 	foreach ($lineas as $numLinea => $linea) {
											 		if($numLinea == $valor) {
											 			echo  substr(htmlspecialchars($linea), 15);
											 			$valor = $valor + 4;
											 		}	
												}
													end7:	
											 	?>"
											></textarea><br/><br/>
										</div>
									</div>

									<div>
										<label>Pregunta 8:</label><br/>
										<label>Introduce la pregunta y las opciones separadas por "punto y coma".</label><br/>
										<div class="abajoPregunta">
											<input type="checkbox" name="opciones[]" value="pregunta8">
											<label>ACTIVAR</label>
											<input type="text" autocomplete="off" name="pregunta8-op1" placeholder="<?php
												if (filesize('preguntas/pregunta8.ini') == 0) {
											 		echo "Introduce aquí la pregunta \r\n";
											 	}
											 	else{
											 		echo file_get_contents('preguntas/pregunta8.ini');
											 	}
											?>"
											/><br/><br/>
											<textarea name="pregunta8-op2" rows="2" placeholder ="<?php
											 		$valor = 3;
											 		$lineas = file('../../assets/js/pregunta8.json', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

												 	if (filesize('../../assets/js/pregunta8.json') == 0) {
												 		echo "Separa las opciones a introducir por punto y coma ';' por ejemplo: \r\n";
											 			echo "ejemplo1;ejemplo2;ejemplo3;ejemplo4;ejemplo5;ejemplo6;ejemplo7;ejemplo8";
												 		goto end8;
												 	}

											 		foreach ($lineas as $numLinea => $linea) {
											 			if($numLinea == $valor) {
											 				echo  substr(htmlspecialchars($linea), 15);
											 				$valor = $valor + 4;
											 			}	
													}
														end8:	
											 	?>"
											></textarea><br/><br/>
										</div>
									</div>

									<div>
										<label>Pregunta 9:</label><br/>
										<label>Introduce la pregunta y las opciones separadas por "punto y coma" de la pregunta 9.</label><br/>
										<div class="abajoPregunta">
											<input type="checkbox" name="opciones[]" value="pregunta9">
											<label>ACTIVAR</label>
											<input type="text" autocomplete="off" name="pregunta9-op1" placeholder="<?php
												if (filesize('preguntas/pregunta9.ini') == 0) {
											 		echo "Introduce aquí la pregunta \r\n";
											 	}
											 	else{
											 		echo file_get_contents('preguntas/pregunta9.ini');
											 	}
											?>"
											/><br/><br/>
											<textarea name="pregunta9-op2" rows="2" placeholder ="<?php
											 		$valor = 3;

											 		if (filesize('../../assets/js/pregunta9.json') == 0) {
												 		echo "Separa las opciones a introducir por punto y coma ';' por ejemplo: \r\n";
											 			echo "ejemplo1;ejemplo2;ejemplo3;ejemplo4;ejemplo5;ejemplo6;ejemplo7;ejemplo8;ejemplo9";
												 		goto end9;
												 	}

											 		$lineas = file('../../assets/js/pregunta9.json', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
											 		foreach ($lineas as $numLinea => $linea) {
											 			if($numLinea == $valor) {
											 				echo  substr(htmlspecialchars($linea), 15);
											 				$valor = $valor + 4;
											 			}	
													}
														end9:	
											 	?>"
											></textarea><br/><br/>
										</div>
									</div>

									<div>
										<label>Pregunta 10:</label><br/>
										<label>Introduce la pregunta y las opciones separadas por "punto y coma".</label><br/>
										<div class="abajoPregunta">
											<input type="checkbox" name="opciones[]" value="pregunta10">
											<label>ACTIVAR</label>
											<input type="text" autocomplete="off" name="pregunta10-op1" placeholder="<?php
												if (filesize('preguntas/pregunta10.ini') == 0) {
											 		echo "Introduce aquí la pregunta \r\n";
											 	}
											 	else{
											 		echo file_get_contents('preguntas/pregunta10.ini');
											 	}
											?>"
											/><br/><br/>
											<textarea name="pregunta10-op2" rows="2" placeholder ="<?php
											 		$valor = 3;
											 		$lineas = file('../../assets/js/pregunta10.json', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

											 		if (filesize('../../assets/js/pregunta10.json') == 0) {
												 		echo "Separa las opciones a introducir por punto y coma ';' por ejemplo: \r\n";
											 			echo "ejemplo1;ejemplo2;ejemplo3;ejemplo4;ejemplo5;ejemplo6;ejemplo7;ejemplo8;ejemplo9;ejemplo10";
												 		goto end10;
												 	}

											 		foreach ($lineas as $numLinea => $linea) {
											 			if($numLinea == $valor) {
											 				echo  substr(htmlspecialchars($linea), 15);
											 				$valor = $valor + 4;
											 			}	
													}
														end10:	
											 	?>"
											></textarea><br/><br/>
										</div>
									</div>

									<div>
										<label>Pregunta 11:</label><br/>
										<label>Introduce la pregunta y las opciones separadas por "punto y coma".</label><br/>
										<div class="abajoPregunta">
											<input type="checkbox" name="opciones[]" value="pregunta11">
											<label>ACTIVAR</label>
											<input type="text" autocomplete="off" name="pregunta11-op1" placeholder="<?php
												if (filesize('preguntas/pregunta11.ini') == 0) {
											 		echo "Introduce aquí la pregunta \r\n";
											 	}
											 	else{
											 		echo file_get_contents('preguntas/pregunta11.ini');
											 	}
											?>"
											/><br/><br/>
											<textarea name="pregunta11-op2" rows="2" placeholder ="<?php
											 		$valor = 3;
											 		$lineas = file('../../assets/js/pregunta11.json', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

											 		if (filesize('../../assets/js/pregunta11.json') == 0) {
												 		echo "Separa las opciones a introducir por punto y coma ';' por ejemplo: \r\n";
											 			echo "ejemplo1;ejemplo2;ejemplo3;ejemplo4;ejemplo5;ejemplo6;ejemplo7;ejemplo8;ejemplo9;ejemplo10";
												 		goto end11;
												 	}

											 		foreach ($lineas as $numLinea => $linea) {
											 			if($numLinea == $valor) {
											 				echo  substr(htmlspecialchars($linea), 15);
											 				$valor = $valor + 4;
											 			}	
													}
														end11:	
											 	?>"
											></textarea><br/><br/>
										</div>
									</div>

									<div>
										<label>Pregunta 12:</label><br/>
										<label>Introduce la pregunta y las opciones separadas por "punto y coma".</label><br/>
										<div class="abajoPregunta">
											<input type="checkbox" name="opciones[]" value="pregunta12">
											<label>ACTIVAR</label>
											<input type="text" autocomplete="off" name="pregunta12-op1" placeholder="<?php
												if (filesize('preguntas/pregunta12.ini') == 0) {
											 		echo "Introduce aquí la pregunta \r\n";
											 	}
											 	else{
											 		echo file_get_contents('preguntas/pregunta12.ini');
											 	}
											?>"
											/><br/><br/>
											<textarea name="pregunta12-op2" rows="2" placeholder ="<?php
											 		$valor = 3;
											 		$lineas = file('../../assets/js/pregunta12.json', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

											 		if (filesize('../../assets/js/pregunta12.json') == 0) {
												 		echo "Separa las opciones a introducir por punto y coma ';' por ejemplo: \r\n";
											 			echo "ejemplo1;ejemplo2;ejemplo3;ejemplo4;ejemplo5;ejemplo6;ejemplo7;ejemplo8;ejemplo9;ejemplo10";
												 		goto end12;
												 	}

											 		foreach ($lineas as $numLinea => $linea) {
											 			if($numLinea == $valor) {
											 				echo  substr(htmlspecialchars($linea), 15);
											 				$valor = $valor + 4;
											 			}	
													}
														end12:	
											 	?>"
											></textarea><br/><br/>
										</div>
									</div>

									<div>
										<label>Pregunta 13:</label><br/>
										<label>Introduce la pregunta y las opciones separadas por "punto y coma".</label><br/>
										<div class="abajoPregunta">
											<input type="checkbox" name="opciones[]" value="pregunta13">
											<label>ACTIVAR</label>
											<input type="text" autocomplete="off" name="pregunta13-op1" placeholder="<?php
												if (filesize('preguntas/pregunta13.ini') == 0) {
											 		echo "Introduce aquí la pregunta \r\n";
											 	}
											 	else{
											 		echo file_get_contents('preguntas/pregunta13.ini');
											 	}
											?>"
											/><br/><br/>
											<textarea name="pregunta13-op2" rows="2" placeholder ="<?php
											 		$valor = 3;
											 		$lineas = file('../../assets/js/pregunta13.json', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

											 		if (filesize('../../assets/js/pregunta13.json') == 0) {
												 		echo "Separa las opciones a introducir por punto y coma ';' por ejemplo: \r\n";
											 			echo "ejemplo1;ejemplo2;ejemplo3;ejemplo4;ejemplo5;ejemplo6;ejemplo7;ejemplo8;ejemplo9;ejemplo10";
												 		goto end13;
												 	}

											 		foreach ($lineas as $numLinea => $linea) {
											 			if($numLinea == $valor) {
											 				echo  substr(htmlspecialchars($linea), 15);
											 				$valor = $valor + 4;
											 			}	
													}
														end13:	
											 	?>"
											></textarea><br/><br/>
										</div>
									</div>

									<div>
										<label>Pregunta 14:</label><br/>
										<label>Introduce la pregunta y las opciones separadas por "punto y coma".</label><br/>
										<div class="abajoPregunta">
											<input type="checkbox" name="opciones[]" value="pregunta14">
											<label>ACTIVAR</label>
											<input type="text" autocomplete="off" name="pregunta14-op1" placeholder="<?php
												if (filesize('preguntas/pregunta14.ini') == 0) {
											 		echo "Introduce aquí la pregunta \r\n";
											 	}
											 	else{
											 		echo file_get_contents('preguntas/pregunta14.ini');
											 	}
											?>"
											/><br/><br/>
											<textarea name="pregunta14-op2" rows="2" placeholder ="<?php
											 		$valor = 3;
											 		$lineas = file('../../assets/js/pregunta14.json', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

											 		if (filesize('../../assets/js/pregunta14.json') == 0) {
												 		echo "Separa las opciones a introducir por punto y coma ';' por ejemplo: \r\n";
											 			echo "ejemplo1;ejemplo2;ejemplo3;ejemplo4;ejemplo5;ejemplo6;ejemplo7;ejemplo8;ejemplo9;ejemplo10";
												 		goto end14;
												 	}

											 		foreach ($lineas as $numLinea => $linea) {
											 			if($numLinea == $valor) {
											 				echo  substr(htmlspecialchars($linea), 15);
											 				$valor = $valor + 4;
											 			}	
													}
														end14:	
											 	?>"
											></textarea><br/><br/>
										</div>
									</div>

									<div>
										<label>Pregunta 15:</label><br/>
										<label>Introduce la pregunta y las opciones separadas por "punto y coma".</label><br/>
										<div class="abajoPregunta">
											<input type="checkbox" name="opciones[]" value="pregunta15">
											<label>ACTIVAR</label>
											<input type="text" autocomplete="off" name="pregunta15-op1" placeholder="<?php
												if (filesize('preguntas/pregunta15.ini') == 0) {
											 		echo "Introduce aquí la pregunta \r\n";
											 	}
											 	else{
											 		echo file_get_contents('preguntas/pregunta15.ini');
											 	}
											?>"
											/><br/><br/>
											<textarea name="pregunta15-op2" rows="2" placeholder ="<?php
											 		$valor = 3;
											 		$lineas = file('../../assets/js/pregunta15.json', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

											 		if (filesize('../../assets/js/pregunta15.json') == 0) {
												 		echo "Separa las opciones a introducir por punto y coma ';' por ejemplo: \r\n";
											 			echo "ejemplo1;ejemplo2;ejemplo3;ejemplo4;ejemplo5;ejemplo6;ejemplo7;ejemplo8;ejemplo9;ejemplo10";
												 		goto end15;
												 	}

											 		foreach ($lineas as $numLinea => $linea) {
											 			if($numLinea == $valor) {
											 				echo  substr(htmlspecialchars($linea), 15);
											 				$valor = $valor + 4;
											 			}	
													}
														end15:	
											 	?>"
											></textarea><br/><br/>
										</div>
									</div>
									<!-- //INTRODUCE DE AQUÍ PARA ABAJO EL CÓDIGO PARA OPCIONES DE LAS PREGUNTAS, PON CUANTAS QUIERAS -->	
									
									<!-- //FIN CODIGO AÑADIR PREGUNTAS -->
									<input type="submit" name="submit" class="btn btn-grey btnInit" style="margin-left: 43%;">
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		<script src="../../assets/js/sidenav.js"></script>
		<script src="../../assets/js/jquery-1.11.1.min.js"></script>
	    <script src="../../assets/bootstrap/js/bootstrap.min.js"></script> 
    </body>
</html>