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
					<div class="form-box ">
						<div class="welcome">
							<div class="header">
								<p class="title"><span>Buscando cuestionario aleatorio... <br/> Haz click en el botón para empezar.</span></p>			
							</div>
						</div>
						<div class="cuestionario">
							<?php require("u/usuario.php");?>
						</div>
					</div>
				</div>
			</div>
		</div>
    </body>
</html>