<?php
  session_start();
  //Guardo la ID del cuestionario que hemos hecho en el "index.php"
  $id = ($_SESSION['id']);

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

                //Contamos los caracteres que tiene el comentario introducido por el usuario
                $maxCaracteres = strlen($comentario);

                //Abrimos el fichero "comentarios.txt" con permisos de escritura
                $crearComentario = fopen("backend/u/cfg/comentarios.txt","a");
                  //Si "$comentario" no esta vacio entra en el if
                  if ($comentario != '') {
                    //Entra en el if cuando los caracteres del comentario son menores que 3500 --> Para poner mas o menos caracteres
                    //tendriamos que modificar el 3501
                    if ($maxCaracteres < 3501) {
                      //Leemos el fichero "$id.json" que acaba de rellenar el usuario
                      $ficheroJson = file_get_contents("res/$id/$id.json");
                      //Quitamos los caracteres especiales y emepzamos a contar desde el caracter "192"
                      $limpiandoJson = substr(preg_replace('/[\[" "]+/', '', $ficheroJson), 192, -1);
                      //Quitamos todo lo que sea ",null"
                      $jsonLimpio = str_replace(',null', '', $limpiandoJson);
                      //Convertimos en array "$jsonLimpio" y lo separado por comas ","
                      $arrayJson = explode(",", $jsonLimpio);

                      $cont = 0;
                      //Cuando "$i" es menor que "16" entrara en el if y se repetira 
                      //el interior de "for" "15" veces
                      //Si queremos más o menos preguntas tendremos que modificar el numero "16"
                      for ($i=1; $i < 16 ; $i++) {


                        //Leemos el fichero "pregunta$i.conf" y si tiene contenido dentro entrara en el if
                        if (filesize("backend/u/cfg/conteJson/pregunta$i.conf") !== 0) {
                          //Guardamos el contenido del fichero "pregunta$i.conf"
                          $lineas = file("backend/u/cfg/conteJson/pregunta$i.conf", FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

                          //Recorremos "$lineas"
                          foreach ($lineas as $numLinea => $linea) {
                            //Convertimos en array "linea" y lo separamos por comas ","
                            $array = explode(",", $linea);
                            //Si "$arrayJson[$cont]" es igual a "$array[0])" entra en el if
                            //$arrayJson[$cont] --> Es el que valor que escogio el usuario en las opciones del cuestionario
                            //$array[0] --> Es el valor de cada opcion que hay en el cuestionario 
                            if ($arrayJson[$cont] == $array[0]) {
                              //Guardamos en datos el "$array[1]" sin que sobreescriba su contenido
                              $datos .= '"' . trim($array[1]) . '", ';
                            }
                          }
                          $cont++;
                        }
                      }

                      //Guardamos "$datos" y le quitamos los "2" ultimos caracteres
                      $datoslimpios = substr($datos, 0, -2);

                      //Escribimos las opciones escogidas por el usuario que esta haciendo el cuestionario
                      fwrite($crearComentario, "Opciones Escogidas --> $datoslimpios" . "\r\n");
                      fwrite($crearComentario, "\r\n");
                      //Escribimos el "$comentario" introducido por el usuario con un salto de linea
                      fwrite($crearComentario, '"' . $comentario . '"' . "\r\n");
                      fwrite($crearComentario, "-----------------------------------------------------------------------" ."\r\n");
                      
                      //Llamamos a la funcion "incrementClickCount" 
                      incrementClickCount();

                      //Redirigimos a la pagina "gracias.php"
                      echo '<META http-equiv="REFRESH" CONTENT="0;URL=gracias.php">';
                    }
                    else{
                       //Si el usuario a introducido mas de "3500" caracteres le saldra el siguiente mensaje
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

            //CODE BY
            //https://github.com/realdaveblanch
            //https://github.com/X-aaron-X
          ?>
        </form>
      </div>
    </div>
  </body>
</html>