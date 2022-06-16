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
        <link rel="icon"  href="../assets/img/favi.png">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">	
    </head>
    <body>
        <!-- Top content -->
        <div class="divText">
        <div class="blanco top-content">
			<div class=" logos">
                <img src="../assets/img/Ibersys.jpg" alt="">
				<img src="../assets/img/logo.png" alt="">

			</div>
            <div class="contText">
				<form  class="form-box login" method="post" action="comprobarLogin.php">
					<label>Usuario</label>
					<input class="minisculas" type="text" name="usuario" required/>
					<label>Contraseña</label>
					<input type="password" id="id_password" name="pass" required/>
					<br>
					<input type="checkbox" onclick="myFunction()">Mostrar contraseña
					<script>
						function myFunction() {
							var x = document.getElementById("id_password");
							if (x.type === "password") {
								x.type = "text";
							} 
							else{
								x.type = "password";
							}
						}
					</script>				
					<input class="btn btn-grey btnInit" type="submit" value="Iniciar Sesión" style="margin-left: 24%;margin-top: 21px;">	
					<input class="btn btn-grey btnInit" type="hidden" name="submitted" value="Iniciar Sesión">
				</form>
				<div class="centrarCuest">
					<?php
						//CODE BY
					    //https://github.com/realdaveblanch
					    //https://github.com/X-aaron-X
					?>
					<button class="cuestAzul btn btn-grey btnInit" style="color: white;" onclick ="location.href='encuesta.php'">Realizar Cuestionario</button><br/><br/>
				<div>
			</div>
			</div>
        </div>
    </body>
</html>
