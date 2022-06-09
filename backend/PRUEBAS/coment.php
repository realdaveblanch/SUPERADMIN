<?php
	//CHECK QUE SE LE HA ASIGNADO UNA COOKIE EN INDEX.PHP
  if(isset($_COOKIE['cuestionario'])){
		echo ''; 
	}
	else {
		//SI NO TIENE UNA COOKIE ASIGNADA, LE MANDA A GRACIAS.PHP
		echo "<META http-equiv=".'"REFRESH"'." CONTENT=".'"0;URL=gracias.php"'.">";	
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
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/fonts/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/style2.css">
    <link rel="icon"  href="assets/img/favi.png">
  </head>
  <body>
    <!-- Top content -->
    <div class="divText">
      <div class="blanco top-content">
        <div class=" logos">  
          <img src="assets/img/Ibersys.jpg" alt="">
				  <img src="assets/img/logo.png" alt="">
        </div>
      </div>
    </div>
    <div class="contText">
      <div class="form-box">
        <h1 style="text-align: center;">¿Quieres enviar algún comentario u observacion adicional?</h1>
        <h4 style="text-align: center;">Esta respuesta no es obligatoria. Puedes darle al botón de finalizar.</h4><br/><br/><br/>                        
        <form method="post" action="#">
          <div class="coment">
            <textarea name="comentarios" rows="10" style="margin-left: 11%;"></textarea><br/><br/>
          </div>
          <input type="submit" name="submit" value="Finalizar Test" class="finalizar btn btn-grey btnInit" style="color: white;"><br/><br/>
          <?php
            if(isset($_POST['comentarios'])){
                $comentario = $_POST["comentarios"];

                  $crearComentario = fopen("backend/u/cfg/comentarios.txt","a");
                    if ($comentario != '') {
                      fwrite($crearComentario, '"' . $comentario . '"' . "\r\n");
                      fwrite($crearComentario, "-----------------------------------------------------------------------" ."\r\n");
                      
                      incrementClickCount();
                     }
                  fclose($crearComentario);

                  echo '<META http-equiv="REFRESH" CONTENT="0;URL=gracias.php">';
            }

      			function getClickCount() {
      				return (int)file_get_contents("backend/u/cfg/comentarios.ini");
      			}

      			function incrementClickCount() {
      				$count = getClickCount() + 1;
      				file_put_contents("backend/u/cfg/comentarios.ini", $count);
      			}
          ?>
        </form>
      </div>
    </div>
  </body>
</html>