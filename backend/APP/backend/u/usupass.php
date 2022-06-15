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
        <title>ADMIN PANEL <?php echo file_get_contents('cfg/hostname.ini'); ?></title>
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
					<a href="usupass.php">CAMBIAR CONTRASEÑA</a>
					<a href="../../readme/INSTRUCCIONES-APP-ADMIN.pdf">AYUDA</a>
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
					<div class="form-box ">
						<button class="atrasDere2 btn btn-grey btnInit" onclick ="location.href='ad.php'">Atrás</button><br/><br/>
						<form class="datos" method="post" action="#" style="margin-bottom: 55px;">
							<p style="font-size: 20px;font-weight: bold;">Cambiar contraseña del cliente</p>
							<label>Introduce la nueva contaseña</label>
							<input type="text"autocomplete="off" name="passUsuario"/>
							<button class="btn btn-grey btnInit" style="margin-top: -3px;margin-bottom: 7px;" type="submit" name="cli">Cambiar</button>
							<?php
								//Si pulsamos el boton "cambiar" de cliente entrara en eel if
								if(isset($_POST['cli'])){
									//Guardamos el contenido de "passUsuario"
									$ssapCli = $_POST['passUsuario'];

									//El fichero "ssapetnecli.ini" lo ponemos en blanco
									file_put_contents("cfg/ssap/ssapetnecli.ini", '', LOCK_EX);
									//En el fichero "ssapetnecli.ini" guardamos la contraseña para el cliente
									file_put_contents("cfg/ssap/ssapetnecli.ini", $ssapCli, LOCK_EX);
									echo "<h5> Se ha cambiado la contraseña </h5>";
								}
							?>	
						</form>

						<form class="datos" method="post" action="#" style="margin-bottom: 55px; margin-top: -79px;">
							<p style="font-size: 20px;font-weight: bold;">Cambiar contraseña del administrador</p>
							<label>Introduce la nueva contaseña</label>
							<input type="text"autocomplete="off" name="passAdmin"/>
							<button class="btn btn-grey btnInit" style="margin-top: -3px;margin-bottom: 7px;" type="submit" name="ad">Cambiar</button>
							<?php
								//Si pulsamos el boton "cambiar" de administrador entrara en eel if
								if(isset($_POST['ad'])){
									//Guardamos el contenido de "passAdmin"
									$ssapAd = $_POST['passAdmin'];

									//El fichero "ssapnimda.ini" lo ponemos en blanco
									file_put_contents("cfg/ssap/ssapnimda.ini", '', LOCK_EX);
									//En el fichero "ssapnimda.ini" guardamos la contraseña para el administrador
									file_put_contents("cfg/ssap/ssapnimda.ini", $ssapAd, LOCK_EX);
									echo "<h5> Se ha cambiado la contraseña </h5>";
								}
							?>	
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