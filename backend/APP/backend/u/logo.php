<?php
	//CHECK DE LOGIN O REDIRIGIR AL LOGIN
    if(isset($_COOKIE['user_name'])){
		echo ''; 
	}
	else {
		echo "<META http-equiv=".'"REFRESH"'." CONTENT=".'"0;URL=../index.php"'.">";	
		exit;
	}

  //Código del uploader
  class config {
    //Tipo de fichero permitido
    static $allowedFiles = ["png"];
    //Directorio de subida
    static $uploadDir = "../../assets/img/";
    //Tamaño máximo
    static $maxFileSize = 20 * 1000000; // 20mb
  }

  //Declaración de la función
  function uploadFile() {
    $target_file = config::$uploadDir.basename($_FILES["file"]["name"]);
    $extention = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

    //Div de los mensajes de estado
    if($_FILES["file"]["size"] > config::$maxFileSize) {
      return [
        "success" => false,
        "reason" => "Logo demasiado grande."
      ];
    }

    if(in_array($extention, config::$allowedFiles) == false) {
      return [
        "success" => false,
        "reason" => "Extensión no permitida."
      ];
    }

    if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
      return [
        "success" => true,
        "reason" => "Logo subido satisfactoriamente."
      ];
    }
    else {
      echo $_FILES["file"]["tmp_name"]."END<br>";
      echo $target_file;
      return [
        "success" => false,
        "reason" => "ERROR inesperado."
      ];
    }
  }

  $status = "";

  //Div de los mensajes de estado
  if(isset($_FILES["file"])) {
    $success = uploadFile();
    if($success["success"] == true) {
      $status = '<div class="notification-text" role="alert">'.htmlspecialchars($success["reason"]).'</div>';
    } 
    else {
      $status = '<div class="notification-text" role="alert">'.htmlspecialchars($success["reason"]).'</div>';
    }
  }

  $fileTypes = "";
  //Div y estilo de los tipos de formato 
  foreach (config::$allowedFiles as $key => $value) {
    $fileTypes .= '<span class="badge badge-primary">.'.htmlentities($value)."</span> ";
  }

  //CODE BY
	//https://github.com/realdaveblanch
	//https://github.com/X-aaron-X
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
		  <! -- Estos son los stylesheets del banner del admin -->
		  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css">
		  <link rel='stylesheet' href='https://fonts.googleapis.com/icon?family=Material+Icons'>
		  <link rel="stylesheet" href="../../assets/css/banner.css">
		  <link rel="stylesheet" href="../../assets/css/bannerset.css">
		  <?php
			 $ua = $_SERVER['HTTP_USER_AGENT'];
			 $id = sha1(rand(111111,999999));
				echo "<script> location.hash='user_token_id=$id&acc=administrator&&$ua';</script>";
			?>	
		  <! -- FIN del banner del admin -->
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
    <br>
    <div class="contText">
      <div class="form-box ">
        <button class="atrasDere btn btn-grey btnInit" onclick ="location.href='ad.php'">Atrás</button><br/><br/><br/>
        <p class="lead">Sube un máximo de 1 logo <?php echo $fileTypes; ?> con nombre "logo". El logo anterior será reempazado. (Tamaño máximo <?php echo htmlspecialchars(config::$maxFileSize / 1000000 ."mb"); ?>)</p>
        <?php echo $status; ?>

        <form method="post" enctype="multipart/form-data">
          <div class="form-group">
            <label for="file">Subir logo.png</label>
            <input type="file" class="form-control-file" name="file" id="file">
          </div>
          <button style="margin-top: 20px;" type="submit" class="btn btn-grey btnInit">Subir</button>
          <button type="button" class="btn btn-grey btnInit" onclick="loadDoc()" style="margin-top: 20px;">Eliminar Logos</button>
          <!-- código ajax eliminar logos -->
					<div class="resultadosadmin" id="resetear">
            <script>
							function loadDoc() {
								const xhttp = new XMLHttpRequest();
								xhttp.onload = function() {
								  document.getElementById("resetear").innerHTML =
								this.responseText;
								}
								xhttp.open("GET", "../AJAX/borrarlogos.ini");
								xhttp.send();
							}
            </script>
          </div>
		      <!-- FIN código ajax eliminar logos -->
        </form>
      </div>
    </div>  
		<script src="../../assets/js/jquery-1.11.1.min.js"></script>
		<script src="../../assets/bootstrap/js/bootstrap.min.js"></script>
		<script src="../../assets/js/sidenav.js"></script>
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
   </body>
</html>