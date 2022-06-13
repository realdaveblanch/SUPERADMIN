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
		echo "<script> location.hash='user_token_id=$id&acc=SUPERadministrator&&$ua';</script>";
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
						
						<a href="../../readme/INSTRUCCIONES-SUPERADMIN.pdf">AYUDA</a>
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
							<label style="margin-top: 15px;">CUESTIONARIOS ACTIVOS ACTUALMENTE:</label><br>
							
							<?php
					//Se declara el directorio en el que se va a buscar .ini
					$dir = 'cfg/clones/activos/';
					//Se cuenta el directorio con variable global
					$q   = (count(glob("$dir/*")) === 0) ? 'vacio' : 'hayalgo';
					//Si está vacío se muestra este mensaje	
					if ($q=="vacio") {
						echo "NO HAY APP ACTIVAS!!"; 
					}
					//Si hay .ini se ejecuta el resto del código
					else{
					//Se cuentan los ini que hay
					$files = glob('cfg/clones/activos/*.ini');
					while(list($i, $filename) = each($files)){   
								$options = '';							
					}
					//Por cada .ini se muestra un select
					foreach ($files as $file) {
						$interno = file_get_contents($file);
									$options .= '<a href="'.$interno.'">'.$file.'</a>'.'<br/>';
								}
								
								
								echo $options;
					}
								
								
								
								?>
							</div>
						<form class="datos form3" method="post" action="#">
							<label>Introduce el nombre del nuevo cuestionario, este se creará automáticamente</label>
							<input type="text" name="valorurl"><br/>
							<button class="btn btn-grey btnInit g" type="submit">Guardar valor</button>
							<div style="height: 117px;">
								<label style="margin-top: 15px;">Nombre de la carpeta de destino actual:</label>	
								<p class="prueba"><?php echo file_get_contents('cfg/urlclonar.ini'); ?></p>
							</div>
							<?php
								//Cuando le demos al boton "Guardar valor" entrara en el if
								if(isset($_POST['valorurl'])){
									//Guardo el valor introducido por el usuario en la variable "$data"
									$data = $_POST['valorurl'];
									//Abro el fichero "urlclonar.ini" en modo escritura
									$fp = fopen('cfg/urlclonar.ini', 'a');									
										//Sobreescribe el contenido que tuviese en el fichero "urlclonar.ini" y le pone "nada" para que el fichero quede vacio
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
								<label style="margin-top: 15px;">Ruta de los contenidos:</label>	
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