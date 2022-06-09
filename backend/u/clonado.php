<?php
//CHECK DE LOGIN O REDIRIGIR AL LOGIN
    if(isset($_COOKIE['suprpowers'])){
		echo ''; 
	}
	else {
		echo "<META http-equiv=".'"REFRESH"'." CONTENT=".'"0;URL=../"'.">";
		include 'ip.php';		
		exit;
	}
	?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <meta content="width=device-width, initial-scale=1" name="viewport" />
        <title>SUPERADMIN</title>
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

				</div>
				<div id="mySidenav" class="sidenav">
						<a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
						
						<a href="https://drive.google.com/file/d/1sUcsZNbvDgKrQuJyZtfjNFcolfHKtAxP/view?usp=sharing">AYUDA</a>
					<a href="usupass.php">CAMBIAR CONTRASEÑA SUPER ADMIN</a>
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
						<h1 style="text-align: center;margin-top: 3px;">CREAR CUESTIONARIOS</h1><br/>
						<div style="text-align: center;width: 29%;margin: 0 auto;">
						
						
						<div class="copiaaadmin" id="copia">

												<button class="btn btn-grey btnInit" onclick ="location.href='logout.php'">Cerrar Sesión</button><br/><br/>
							</div>
							<div class="vercopia" id="vercopia">
								<a href="opciones.php" class="btn btn-grey btnInit" name="vercopia">Opciones de los clones</a>
							</div>
							
						
						<div class="resultadosdir">
							<label style="margin-top: 15px;">CUESTIONARIOS CREADOS ACTUALMENTE:</label><br>
							
							<?php
							if (!is_file("cfg/clones.ini")) {
								echo "<h3>No hay clones actualmente.</h3>";
							}
							else{
								echo '<div class="disponibles2" id="disponibles">'; 
									//Cargamos los datos del archivo "valido.php" con permisos de lectura
									$idsValidos = fopen("cfg/clones.ini", "r");
										//Miestras el puntero del archivo "valido.php" no este al final entra en el while
										while(!feof($idsValidos)) {
											$cont2++;
											
											//Guardo la primera linea del archivo "valido.php" y la guardo en la variable $id
											$id = fgets($idsValidos);
											//Guardo los 13 caracteres de $id
											$treceCaracteres = substr($id,0,6);
											
											//Si la $id es distinta que "" entrara en el si
											if($id != ""){	
												$fichero = "cfg/$seisCaracteres.ini";
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
							</div>
						<form class="datos form3" method="post" action="#">
							<label>Introduce el nombre de la nueva carpeta de destino, esta se creará automáticamente</label>
							<input type="text" name="valorurl"><br/>
							<button class="btn btn-grey btnInit g" type="submit">Guardar valor</button>
							<div style="height: 117px;">
								<label style="margin-top: 15px;">Nombre de la carpeta de destino actual:</label>	
								<p class="prueba"><?php echo file_get_contents('cfg/urlclonar.ini'); ?></p>
							</div>
							<?php
								//Cuando le demos al boton "Guardar valor URL" entrara en el if
								if(isset($_POST['valorurl'])){
									//Guardo el valor introducido por el usuario en la variable "$data"
									$data = $_POST['valorurl'];
									//Abro el fichero "url.txt" en modo escritura
									$fp = fopen('cfg/urlclonar.ini', 'a');									
										//Sobreescribe el contenido que tuviese en el fichero "url.txt" y le pone "nada" para que el fichero quede vacio
										file_put_contents('cfg/urlclonar.ini','', LOCK_EX);

									//Esta función crea el valor de url para el clonado, que servirá para backup.php
									fwrite($fp, "../../../" . $data);
									//Y esta función crea el valor url para los cuestionarios, pero de la app clonada
									$fp3 = fopen('cfg/urldefault.ini', 'a');
									file_put_contents('cfg/urldefault.ini','', LOCK_EX);
									fwrite($fp3, "/" . $data . "?id=");
									
									
								}
								
										//CODE BY
								//https://github.com/realdaveblanch
								//https://github.com/X-aaron-X
							?>
							<div style="height: 117px;">
								<label style="margin-top: 15px;">Nombre de la carpeta actual:</label>	
								<p class="prueba"><?php echo file_get_contents('cfg/urlpura.ini'); ?></p>
							</div>
								
					
							<div class="resultadosadmin" id="clonar">
								<a href="backup.php" class="btn btn-grey btnInit" name="clonar">Comenzar Creación</a>
							</div>
							
							
							</div>
							
							
						</form>
						
						
						
		<script src="../../assets/js/sidenav.js"></script>
		<script src="../../assets/js/jquery-1.11.1.min.js"></script>
	    <script src="../../assets/bootstrap/js/bootstrap.min.js"></script> 
    </body>
</html>