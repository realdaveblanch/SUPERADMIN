<?php
	//CHECK DE LOGIN O REDIRIGIR AL LOGIN
    if(isset($_COOKIE['user_name'])){
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
        <title>ADMIN PANEL 1.9</title>
        <!-- CSS -->
        <link rel="stylesheet" href="../../assets/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="../../assets/fonts/font-awesome/css/font-awesome.min.css">
        <link rel="stylesheet" href="../../assets/css/style.css">
		<link rel="stylesheet" href="../../assets/css/style2.css">
		<link rel="stylesheet" href="../../assets/css/sidemenu.css">
        <link rel="icon"  href="../../assets/img/favi.png">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css">
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
					<a href=".php">CAMBIAR CONTRASEÑA</a>
					<a href="https://drive.google.com/file/d/1sUcsZNbvDgKrQuJyZtfjNFcolfHKtAxP/view?usp=sharing">AYUDA</a>
					<a href="logout.php">CERRAR SESIÓN</a>
				</div>
				<span style="font-size:30px;cursor:pointer" onclick="openNav()">&#9776; Menú</span>
				<! -- banner del admin -->
							<div class="container">
								<div class="rectangle">
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
						<?php
							include 'url.php';
							//Tener en cuenta si el protocolo utilizado es http/https, alta posibilidad de error						
							$cont=0;
							$cont2=0;
							echo '<h1 class="aba" style="font-size: 36px;">LISTA DE LINK VALIDOS</h1>';
						?>
						<!-- código ajax descargar resultados -->
						<div class="resultados mo" id="demo">
							<button type="button" class="btn btn-grey btnInit" onclick="loadDoc(); location.href='../resultados.php'">Descargar Resultados</button>
						</div>
						<script>
							function loadDoc() {
								const xhttp = new XMLHttpRequest();
								xhttp.onload = function() {
									document.getElementById("demo").innerHTML =
									this.responseText;
								}
								xhttp.open("GET", "../AJAX/descargando.ini");
								xhttp.send();
							}
						</script>
						<!-- FIN código ajax descargar resultados -->
						<!-- código ajax descargar resultados -->
						<br/><br/><br/>
						<div class="resultados mo" id="demo1">
							<button type="button"  style="margin-top: -7px;" class="btn btn-grey btnInit" onclick="loadDoc1(); location.href='../descomentariosadmin.php'">Descargar Comentarios</button>
						</div>
						<script>
							function loadDoc1() {
								const xhttp = new XMLHttpRequest();
								xhttp.onload = function() {
									document.getElementById("demo1").innerHTML =
									this.responseText;
								}
								xhttp.open("GET", "../AJAX/descargandocom.ini");
								 xhttp.send();
							}
						</script>
						<!-- FIN código ajax descargar resultados -->						
						<button class="salir3" onclick ="location.href='ad.php'">Atrás</button><br/><br/>
						<?php
							if (!is_file("../validos.php")) {
								echo "<h3>No hay cuestionarios creados. Tienes que crear algún cuestionario.</h3>";
							}
							else{
								echo '<div class="disponibles2" id="disponibles">'; 
								//Cargamos los datos del archivo "valido.php" con permisos de lectura
								$idsValidos = fopen("../validos.php", "r");
									//Miestras el puntero del archivo "valido.php" no este al final entra en el while
									while(!feof($idsValidos)) {
										$cont2++;
											
										//Guardo la primera linea del archivo "valido.php" y la guardo en la variable $id
										$id = fgets($idsValidos);
											//Guardo los 13 caracteres de $id
										$treceCaracteres = substr($id,0,13);
											
										//Si la $id es distinta que "" entrara en el si
										if($id != ""){	
											$fichero = "../../res/$treceCaracteres/$treceCaracteres.json";
											//Si el fichero no existe entra en el if
											if (!is_file($fichero)) {
												//Pinta por pantalla las urls con las ids
												echo "<div><a href = '". trim($url.$id) ."'>". trim($url . $id) ."</a></div>";
												echo "<br/>";
												$cont++;
											}				
										}	
									}
								fclose($idsValidos);
									
								$maxLinks = $cont2-1;
								//pre resultados para lastcuest
								$totalhechos = ($maxLinks - $cont);
								echo "<div class=" . '"' . "numCuestadmin" . '"'. ">";
								//echo "<h4>Cuestionarios disponibles " . $cont. ' de '. $maxLinks ."</h4>";
								//echo "<div>";
								//echo "</div>";
							}
							//CODE BY
							//https://github.com/realdaveblanch
							//https://github.com/X-aaron-X
						?>
						<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
						<script>
							$(document).ready(function () {
								setInterval( function() {
									$("#disponibles").load(location.href + " #disponibles");
								}, 3000 );
							});
						</script>
						<! -- ultimo cuestionario -->
						<div class="otherstats" id="last">
							<?php
								//estado último cuestionario realizado
								//Se declara la lectura del fichero como $fh
								$fh = fopen("cfg/lastcuest2.ini", 'r');
									//El valor 25000 representa el número de bytes leídos en buffer ya que el fichero lascuest es leído en binario.
									echo "<br/>";
									$pageText = fread($fh, 25000);
                                    //Pinta por pantalla "$pageText" que es el contenido de "$lastcuest" con un salto de línea.
									echo nl2br($pageText);
									echo '<p><span style="font-weight: bold;"> Total realizados: </span>' . '<span style="color:#01a49e; font-weight: bold; ">' .  $totalhechos . " de " . $maxLinks . '</span></p>';
								fclose($fh);

								//numero de comentarios
								//Se declara la lectura del fichero como $fh
								$fh = fopen("cfg/comentarios.ini", 'r');
									//El valor 25000 representa el número de bytes leídos en buffer ya que el fichero lascuest es leído en binario.
									echo "<br/>";

									echo '<p>';
                                    $pageText2 = fread($fh, 25000);
                                    //Pinta por pantalla "$pageText" que es el contenido de "$lastcuest" con un salto de línea.
									echo '<span style="font-weight: bold;"> Total comentarios: </span>';
									echo '<span style="color:#01a49e; font-weight: bold;">' . nl2br($pageText2) . '</span>';
									echo "<p/>";
									echo "<br/>";	
								fclose($fh);
								
								include("online.php");
							?>
							<span style="font-weight: bold;"> Realizandose ahora: </span><span style="color:#01a49e; font-weight: bold;"><?php echo $visitors_online;?></<span>
						</div>
						<! -- ultimo cuestionario, EN DIRECTO CADA 3 SEGUNDOS -->
						<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
						<script>
							$(document).ready(function () {
								setInterval( function() {
									$("#last").load(location.href + " #last");
								}, 3000 );
							});
						</script>
						<! -- ultimo cuestionario -->	
						  
						</div>
					</div>
				</div>
			</div>
		</div>
		<script src="../../assets/js/sidenav.js"></script>
    </body>
</html>