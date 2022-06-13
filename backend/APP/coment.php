<?php
  session_start();
  //Guardo la ID del cuestionario que hemos hecho en el "index.php"
  $id = ($_SESSION['id']);

	//CHECK QUE SE LE HA ASIGNADO UNA COOKIE EN INDEX.PHP
  if(isset($_COOKIE['cuestionario'])){
		//echo ''; 
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
        <h1 style="text-align: center;">¿Quieres enviar algún comentario u observación adicional?</h1>
        <h4 style="text-align: center;">Esta respuesta no es obligatoria. Puedes darle al botón de finalizar.</h4><br/><br/><br/>                        
        <form method="post" action="#">
          <div class="coment">
            <textarea name="comentarios" rows="10" style="margin-left: 11%;" placeholder="Introduzca aquí su comentario. Dispone de 3500 caracteres"></textarea><br/><br/>
          </div>
          <input type="submit" name="submit" value="Finalizar" class="finalizar btn btn-grey btnInit" style="color: white;"><br/><br/>
          <?php
            //Cuando le demos al boton "Finalizar Test" entrara en el if
            if(isset($_POST['comentarios'])){
                //Guardamos el contenido de "textarea" en "$comentario"
                $comentario = $_POST["comentarios"];
                
                //Ponemos la hora y fecha de España y la guardamos en "$fecha"
                date_default_timezone_set("Europe/Madrid");
                $fecha = date("d/m/Y H:i:s");

                //Abrimos el fichero "fecha.ini" con permisos de escritura
                $crearFecha = fopen("backend/u/cfg/fecha.ini","a");
                  //Escribimos la "$fecha" y la "$id" con un salto de linea
                  fwrite($crearFecha, $fecha. ", " .$id . "\r\n");
                fclose($crearFecha);

                $maxCaracteres = strlen($comentario);

                //Abrimos el fichero "comentarios.txt" con permisos de escritura
                $crearComentario = fopen("backend/u/cfg/comentarios.txt","a");
                  //Si "$comentario" no esta vacio entra en el if
                  if ($comentario != '') {
                    //Entra en el if cuando los caracteres del comentario son menores que 3500 --> Para poner mas o menos caracteres
                    //tendriamos que modificar el 3501
                    if ($maxCaracteres < 3501) {
                      //Escribimos el "$comentario" introducido por el usuario con un salto de linea
                      fwrite($crearComentario, '"' . $comentario . '"' . "\r\n");
                      fwrite($crearComentario, "-----------------------------------------------------------------------" ."\r\n");
                      
                      //Llamamos a la funcion "incrementClickCount" 
                      incrementClickCount();

                      //Redirigimos a la pagina "gracias.php"
                      echo '<META http-equiv="REFRESH" CONTENT="0;URL=gracias.php">';
                    }
                    else{
                      echo '<p style="text-align: center; font-size: 18px;">Haz introducido mas de 3500 caracteres</>';
                    }
                  }
                  else{
                    //Redirigimos a la pagina "gracias.php" cuando el usuario le da a finalizar sin menter ningun comentario
                    echo '<META http-equiv="REFRESH" CONTENT="0;URL=gracias.php">';
                  }
                fclose($crearComentario);
            }

            //La funcion guarda el contenido del fichero "comentarios.ini" y lo pasa a int
      			function getClickCount() {
      				return (int)file_get_contents("backend/u/cfg/comentarios.ini");
      			}

            //funcion que cuenta cuantos comentarios se han hecho
      			function incrementClickCount() {
              //contamos el contenido de la funcion "getClickCount" y le sumamos
      				$count = getClickCount() + 1;
              //En el fichero "comentarios.ini" ponemos el resultados de "$count"
      				file_put_contents("backend/u/cfg/comentarios.ini", $count);
      			}
          ?>
        </form>
      </div>
    </div>
  </body>
</html>