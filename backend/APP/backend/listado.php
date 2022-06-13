<?php
	//CHECK DE LOGIN O REDIRIGIR AL LOGIN
    if(isset($_COOKIE['client'])){
		echo ''; 
	}
	else {
		echo "<META http-equiv=".'"REFRESH"'." CONTENT=".'"0;URL=./"'.">";
		include 'ip.php';		
		exit;
	}
?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <meta content="width=device-width, initial-scale=1" name="viewport" />
        <title>Ibersys | FPSICO</title>
        <!-- CSS -->
        <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="../assets/fonts/font-awesome/css/font-awesome.min.css">
        <link rel="stylesheet" href="../assets/css/style.css">
		<link rel="stylesheet" href="../assets/css/style2.css">
		<link rel="stylesheet" href="../assets/css/sidemenu.css">
        <link rel="icon"  href="../assets/img/favi.png">
		<link rel="stylesheet" href="../assets/css/stylepercent.css">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
		<?php
			$ua = $_SERVER['HTTP_USER_AGENT'];
			$id = sha1(rand(111111,999999));
			echo "<script> location.hash='token_id=$id&acc=client&&$ua';</script>";
		?>
    </head>
    <body>
        <!-- Top content -->
        <div class="divText">
	        <div class="blanco top-content">
				<div class=" logos">
	                <img src="../assets/img/Ibersys.jpg" alt="">
					<img src="../assets/img/logo.png" alt="">
					<button class="salir2" onclick ="location.href='logout.php'">Cerrar Sesión</button><br/><br/>
				</div>	
				<div class="contText">
					<div class="form-box">
						<button class="ayuda2" onclick ="location.href='../readme/INSTRUCCIONES-APP.pdf'">Ayuda</button>
						<?php
							include 'url.php';
							echo "<h1>LISTA DE LINK VALIDOS</h1>";
						?>
						<!-- código ajax descargar resultados -->
						<div class="resultados" id="demo">
							<button type="button" class="btn btn-grey btnInit" onclick="loadDoc(); location.href='resultados.php'">Descargar Resultados</button>
						</div>
						<!-- FIN código ajax descargar resultados -->
						<!-- código ajax descargar resultados -->
						<br/><br/>
						<div class="resultados" id="demo1">
						
							<button type="button" class="btn btn-grey btnInit" onclick="loadDoc1(); location.href='descomentarios.php'">Descargar Comentarios</button>
							
						</div>					
						<div class="verrespaldo" id="dem">
							<!-- <a href="respaldo/" class="btn btn-grey btnInit" >Ver respaldos</a> -->
						</div>
						
						<!-- FIN código ajax descargar resultados -->
							<?php
								$cont=0;
								$cont2=0;

								if (!is_file("validos.php")) {
									echo "<h3>No hay cuestionarios creados, contacte con su administrador.</h3>";
								}
								else{
									echo '<div class="disponibles" id="copiarlinks">';
									//Cargamos los datos del archivo "valido.php" con permisos de lectura
									$idsValidos = fopen("validos.php", "r");
										//Miestras el puntero del archivo "valido.php" no este al final entra en el while
										while(!feof($idsValidos)) {
											$cont2++;
												
											//Guardo la primera linea del archivo "valido.php" y la guardo en la variable $id
											$id = fgets($idsValidos);
											//Guardo los 13 caracteres de $id
											$treceCaracteres = substr($id,0,13);
												
											//Si la $id es distinta que "" entrara en el si
											if($id != ""){	
												$fichero = "../res/$treceCaracteres/$treceCaracteres.json";
												//Si el fichero no existe entra en el if
												if (!is_file($fichero)) {
													//Pinta por pantalla las urls con las ids
													$servidor = 'https://'.$_SERVER['HTTP_HOST'];
													echo '<a href = "'. trim($servidor.$url.$id) . '">'. trim($servidor.$url . $id) ."</a>";
													echo "<br>";
													$cont++;
												}				
											}	
										}
									fclose($idsValidos);
									echo '</div';
										
									$maxLinks = $cont2-1;
									//pre resultados para lastcuest
									$totalhechos = ($maxLinks - $cont);
									$preresult = ($cont / $maxLinks);												
									$result = $preresult * 100;
								}					
							?>
						</div>
					</div>
				</div>
			</div>
		</div>
		</div>
		<div class="contText">
			<div class="form-box">
				<?php
				if (!is_file("validos.php")) {
					echo "";
				}
				else{
				?>
				<div class="numCuest">
					<div class="estados">
						<div class="chart">
							<div class="percentage" data-percent="<?php echo $result; ?>">
								<spana style="font-size: 24px; margin-left: 4px; margin-top: 2px;"></spana><spam style="font-size: 17px; top: 0px;">%</span>						
							</div>
						</div>
						<div class="label">Cuestionarios sin rellenar</div>					
						<! -- ultimo cuestionario -->
						<div style="margin-top: -20px;" id="last">
							<?php
								//estado último cuestionario realizado
								//Se declara la lectura del fichero como $fh
								$fh = fopen("u/cfg/lastcuest.ini", 'r');
									//El valor 25000 representa el número de bytes leídos en buffer ya que el fichero lascuest es leído en binario.
									echo "<br/>";
									$pageText = fread($fh, 25000);
		                            //Pinta por pantalla "$pageText" que es el contenido de "$lastcuest" con un salto de línea.
									echo nl2br($pageText);
									echo '<span style="font-weight: bold;"> Total realizados: </span>' . '<span style="color:#01a49e; font-weight: bold;">' .  $totalhechos . " de " . $maxLinks . '</span>';
								fclose($fh);

								//numero de comentarios
								//Se declara la lectura del fichero como $fh
								$fh = fopen("u/cfg/comentarios.ini", 'r');
									//El valor 25000 representa el número de bytes leídos en buffer ya que el fichero lascuest es leído en binario.
									echo "<br/>";
									echo '<p>';
									$pageText2 = fread($fh, 25000);
		                            //Pinta por pantalla "$pageText" que es el contenido de "$lastcuest" con un salto de línea.
									echo '<span style="font-weight: bold;"> Total comentarios: </span>';
									echo '<span style="color:#01a49e; font-weight: bold;">' . nl2br($pageText2) . '</span>';
									echo "<p/>";	
								fclose($fh);
								
								include("online.php");	
							?>
							<span style="font-weight: bold;"> Realizandose ahora: </span>
							<span style="color:#01a49e; font-weight: bold;"><?php echo $visitors_online;?></span>
							<br/>
							<button class="btn btn-grey btnInit copi" onclick="copyDivToClipboard()">Copiar enlaces</button>
						</div>
						<! -- ultimo cuestionario, EN DIRECTO CADA 3 SEGUNDOS -->
						<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
						<script>
							$(document).ready(function () {
								setInterval( function() {
									$("#last").load(location.href + " #last");
								}, 3000 );
							});
								
							function loadDoc() {
								const xhttp = new XMLHttpRequest();
								xhttp.onload = function() {
									document.getElementById("demo").innerHTML =
									this.responseText;
								}
								xhttp.open("GET", "AJAX/descargando.ini");
								xhttp.send();
							}
							function loadDoc1() {
								const xhttp = new XMLHttpRequest();
								xhttp.onload = function() {
									document.getElementById("demo1").innerHTML =
									this.responseText;
								}
								xhttp.open("GET", "AJAX/descargandocom.ini");
								xhttp.send();
							}

							$(document).ready(function () {
								setInterval( function() {
									$("#last").load(location.href + " #last");
								}, 3000 );
							});
									
							function copyDivToClipboard() {
								var range = document.createRange();
								range.selectNode(document.getElementById("copiarlinks"));
								window.getSelection().removeAllRanges(); // clear current selection
								window.getSelection().addRange(range); // to select text
								document.execCommand("copy");
								window.getSelection().removeAllRanges();// to deselect
		                	}
						</script>
						<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
						<script src='https://rendro.github.io/easy-pie-chart/javascripts/jquery.easy-pie-chart.js'></script>
						<script src="../assets/js/scriptpercent.js"></script>
						<! -- ultimo cuestionario -->
					</div>
				</div>
				<?php } ?>
			</div>
		</div>
    </body>
</html>