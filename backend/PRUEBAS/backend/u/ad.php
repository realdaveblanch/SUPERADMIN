<?php
	//CHECK DE LOGIN O REDIRIGIR AL LOGIN
    if(isset($_COOKIE['user_name'])){
		echo ''; 
	}
	else {
		echo "<META http-equiv=".'"REFRESH"'." CONTENT=".'"0;URL=../admin/index.php"'.">";
		include 'ip.php';		
		exit;
	}
?>
<!DOCTYPE html>
<html lang="es">
    <head>
	    <meta http-Equiv="Cache-Control" Content="no-cache" />
		<meta http-Equiv="Pragma" Content="no-cache" />
		<meta http-Equiv="Expires" Content="0" />
        <meta charset="utf-8">
        <meta content="width=device-width, initial-scale=1" name="viewport" />
        <title>ADMIN PANEL 1.9</title>
        <!-- CSS -->
        <link rel="stylesheet" href="../../assets/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="../../assets/fonts/font-awesome/css/font-awesome.min.css">
        <link rel="stylesheet" href="../../assets/css/style.css">
		<link rel="stylesheet" href="../../assets/css/style2.css">
		<link rel="stylesheet" href="../../assets/css/sidemenu.css">
        <link rel="icon" href="../../assets/img/favi.png">		
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css">
		<link rel='stylesheet' href='https://fonts.googleapis.com/icon?family=Material+Icons'>
		<link rel="stylesheet" href="../../assets/css/banner.css">
		<link rel="stylesheet" href="../../assets/css/bannerset.css">
		<link rel="stylesheet" href="../../assets/css/stylepercent.css">
		<?php
			$ua = $_SERVER['HTTP_USER_AGENT'];
			$id = sha1(rand(111111,999999));
			echo "<script> location.hash='user_token_id=$id&acc=administrator&&$ua';</script>";
		?>
		<meta name="viewport" content="width=device-width, initial-scale=1">
	</head>
	<body>
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
										<i class="material-icons" style="font-size: 45px;">info</i>
										<span style="margin-left: 22px;">Panel de <?php echo file_get_contents('cfg/hostname.ini'); ?><br/><br/>
											<?php
											//php del ultimo acceso							
												if(isset($_COOKIE['lastVisit'])){
													$visit = $_COOKIE['lastVisit'];
													echo "". "  Último login: ". $visit;
												}
												else{
													echo "PELIGRO COOKIES BLOQUEADAS";
												}
											?>
										</span>
									</div>
								</div>
							</div>		
				<! -- FIN banner del admin -->
				<! -- PORCENTAJES -->
				<div id="estados" style="width: 304px;margin: 0 auto;">
					<?php
						if (!is_file("../validos.php")) {
							echo "";
								}
						else{
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
												$cont++;
											}				
										}	
								}
							fclose($idsValidos);
							$maxLinks = $cont2-1;
						//pre resultados para lastcuest
						$totalhechos = ($maxLinks - $cont);
						//Se calcula el porcentaje
						$preresult = ($cont / $maxLinks);
												
						$result = $preresult * 100;
							}		
						//pre resultados para lastcuest
						$totalhechos = ($maxLinks - $cont);
						//Se calcula el porcentaje
						$preresult = ($cont / $maxLinks);
												
						$result = $preresult * 100;
					?>
					<div class="estados">
						<div class="chart">
							<div class="percentage" data-percent="<?php echo $result; ?>">
								<spana style="font-size: 24px; margin-left: 4px; margin-top: 2px;"></spana><spam style="font-size: 17px; top: 0px;">%</span>
							</div>
						</div>		
						<div class="label">Cuestionarios sin rellenar
							<div class="otherstats" id="last" style="margin: 0 auto; margin-top: -20px;">
								<?php
									//estado último cuestionario realizado
									//Se declara la lectura del fichero como $fh
									$fh = fopen("cfg/lastcuest.ini", 'r');
                                        //El valor 25000 representa el número de bytes leídos en buffer ya que el fichero lascuest es leído en binario.
										echo "<br/>";
                                        $pageText = fread($fh, 25000);
                                        //Pinta por pantalla "$pageText" que es el contenido de "$lastcuest" con un salto de línea.
										echo nl2br($pageText);
										echo '<span style="font-weight: bold;"> Total realizados: </span>' . '<span style="color:#01a49e; font-weight: bold;">' .  $totalhechos . " de " . $maxLinks . '</span>';
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
                                    fclose($fh);
								?>
								<?php include("online.php");?>
								<span style="font-weight: bold;"> Realizandose ahora: </span>
								<span style="color:#01a49e; font-weight: bold;"><?php echo $visitors_online;?>
								<br/><br/>
							</div>
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
				<! -- PORCENTAJES -->
				<div class="contText">
					<div class="form-box ">
						<button class="listado btn btn-grey btnInit" onclick ="location.href='adminlist.php'">Ver listado</button>
						<form class="datos" method="post" action="#" style="margin-bottom: 55px;">
							<label>Introduce cuántos cuestionarios quieres crear.</label>
							<input type="text"autocomplete="off" pattern="[0-9]*" name="numIDs"/>
							<button class="btn btn-grey btnInit" style="margin-top: -3px;margin-bottom: 7px;" type="submit" name="crearIDs">Crear</button>
							<button class="btn btn-grey btnInit" style="margin-top: -3px;margin-bottom: 7px;" type="submit" name="crearIDs">Añadir</button>
							<?php
								//Si el formulario es "post" y se le da click al boton de "crear" entrara en el if
								if(isset($_POST['crearIDs'])){
									require("crearIDs.php");
								}
							?>	
						</form>
						<form class="datos form2" method="post" action="#">
							<label>Introduce la URL que va a utilizar</label>
							<input type="text" name="valorurl"><br/>
							<button class="btn btn-grey btnInit g" type="submit">Guardar</button>
							<?php
								//Cuando le demos al boton "Guardar valor URL" entrara en el if
								if(isset($_POST['valorurl'])){
									//Guardo el valor introducido por el usuario en la variable "$data"
									$data = $_POST['valorurl'];
									//Abro el fichero "url.txt" en modo escritura
									$fp = fopen('cfg/url.ini', 'a');
										//Sobreescribe el contenido que tuviese en el fichero "url.txt" y le pone "nada" para que el fichero quede vacio
										file_put_contents('cfg/url.ini','', LOCK_EX);

										//Escribimos en el fichero "url.txt" lo que introdujo el usuario
										fwrite($fp, "/" . $data . "?id=");
									fclose($fp);
									//Esta función crea el valor de url para el clonado, que servirá para backup.php
									$fp2 = fopen('cfg/urlpura.ini', 'a');
									file_put_contents('cfg/urlpura.ini','', LOCK_EX);
									fwrite($fp2, "../../../" . $data);
									$fp4 = fopen('cfg/hostname.ini', 'a');
									file_put_contents('cfg/hostname.ini','', LOCK_EX);
									fwrite($fp4, $data);
								}
								
								//CODE BY
								//https://github.com/realdaveblanch
								//https://github.com/X-aaron-X
							?>
							<div style="height: 117px;">
								<label style="margin-top: 15px;">Valor URL actual:</label>	
								<p class="prueba"><?php echo file_get_contents('cfg/url.ini'); ?></p>
							</div>

							<! -- Botones -->
							<a href="../resultados.php" class="btn btn-grey btnInit dr" name="descargar"style="color:black;" style="text-decoration:none;" target=”_blank”>Descargar resultados</a><br/><br/>

							<a href="../descomentariosadmin.php" class="btn btn-grey btnInit dc" name="descargarComent" style="color:black;" style="text-decoration:none;" target=”_blank”>Descargar Comentarios</a>
	
							<a href="../directorycreate.php" class="btn btn-grey btnInit ac" name="activarRes" type="submit">Activar Cuestionarios</a>
			
							<div class="resultadosadmin" id="resetear">
								<button type="button" class="btn btn-grey btnInit rc" onclick="loadDoc()" style="color:white; background: #a64c4c; ">Resetear Cuestionarios</button>
							</div>
							<div class="resultados mo" id="demo1">
							<! -- FIN Botones -->
						</div>
							<script>
								/* código ajax descargar resultados */
								function loadDoc() {
									const xhttp = new XMLHttpRequest();
									xhttp.onload = function() {
										document.getElementById("resetear").innerHTML =
										this.responseText;
									}

									xhttp.open("GET", "../AJAX/resetear.ini");
									xhttp.send();
								}
								/* FIN código ajax descargar resultados */
							</script>
						</form>
					</div>
				</div>
			</div>
			<script src="../../assets/js/jquery-1.11.1.min.js"></script>
			<script src="../../assets/bootstrap/js/bootstrap.min.js"></script>
			<script src="../../assets/js/sidenav.js"></script>
			<script src="../../assets/js/scriptpercent.js"></script>		  
    </body>
</html>