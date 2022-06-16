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
									<?php
										//Cuando "$i" es menor que "16" entrara en el if y se repetira el interior de "for" "15" veces
										//Si queremos más o menos preguntas tendremos que modificar el numero "16"
										for ($i=1; $i < 16 ; $i++) {
											echo '<div>';
											echo "<label>Pregunta $i:</label><br/>";
											echo '<label>Introduce la pregunta y las opciones separadas por "punto y coma".</label><br/>';

											echo '<div class="abajoPregunta">';
											echo '<input type="checkbox" name="opciones[]" value="pregunta'.$i.'">';
											echo '<label>ACTIVAR</label>';
											echo '<input type="text" autocomplete="off" name="pregunta'.$i.'-op1"';
											echo ' placeholder="';
											//Si el fichero "pregunta$i.ini" esta vacio entrara en el if
											if (filesize("preguntas/pregunta$i.ini") == 0) { 
													echo "Introduce aquí la pregunta \r\n";
											}
											else{
											 	//Muestra el contenido de "pregunta$i.ini"
											 	echo file_get_contents("preguntas/pregunta$i.ini");
											 }
											echo '"';
											echo '/><br/><br/>';

											echo '<textarea name="pregunta'.$i.'-op2" rows="2"';
											echo ' placeholder="';
											 	//Guardamos el valor "3" porque en "pregunta$i.json" la línea que queremos leer es "nm"
											 	$valor = 3;
											 	//Guardamos el fichero "pregunta$i.json" completo en un array
											 	//Ademas omitimos la nueva línea al final de cada elemento del array
											 	//Y nos saltamos las líneas vacías
											 	$lineas = file("../../assets/js/pregunta$i.json", FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

											 	//Si el fichero "pregunta$i.json" esta vacio entrara en el if y nos saldra un mensaje
											 	if (filesize("../../assets/js/pregunta$i.json") == 0) {
											 		echo "Separa las opciones a introducir por punto y coma ';' por ejemplo: \r\n";
											 		echo "ejemplo1; ejemplo2; ejemplo3; ejemplo4; ejemplo5";
											 	}
											 	//Si el fichero tiene contenido entrara en el "else"
											 	else{
											 		//Recorremos "$lineas"
											 		foreach ($lineas as $numLinea => $linea) {
												 		//Si "$numLinea" es igual a "$valor" entrara en el if
												 		if($numLinea == $valor) {
												 			//Convertimos los caracteres especiales en entidades HTML y los pintamos
												 			//por pantalla apartir del caracter "15" 
												 			echo substr(htmlspecialchars($linea), 15);
												 			
												 			//Sumamos "4" a "$valor" porque la línea que queremos leer es "nm"
												 			$valor = $valor + 4;
												 		}	
													}
											 	}
												echo '"';
											echo '></textarea><br/><br/>';
											echo '</div>';
											echo '</div>';
										}
										
										//CODE BY
										//https://github.com/realdaveblanch
										//https://github.com/X-aaron-X
									?>
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