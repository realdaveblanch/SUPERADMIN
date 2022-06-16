<?php
    session_start();
    //Se declara la cookie como lo que haya delante de ?id=
    $cookie = htmlspecialchars($_GET["id"]); 
    // Se asigna un cookie al inicio de sesion del cuestionario
    setcookie("cuestionario", $cookie, time()+ 3600,'/'); 
    // la cookie expira a la hora y la sesión será destruida automáticamente

    $dbfile = "backend/u/cfg/conectados.db"; // ruta a la base de datos de conectados
    $expire = 1300; //tiempo para considerar a alguien online 21 MIN;) (después de este tiempo la ip expira y el contador baja)
    //Si la base de datos no existe mostraba un, mensaje 
    if(!file_exists($dbfile)) {
        echo "";
    }
    //Si la base de datos no es de escritura mostraba otro mensaje
    if(!is_writable($dbfile)) {
        echo "";
    }
    //Esta función accede a la base de datos y cuenta las direcciones ip 
    function contaractivos() {
        global $dbfile, $expire;
        //Se declara la función getIp en una variable
        $cur_ip = getIP();
        //Junto con el tiempo en formato unix
        $cur_time = time();
        $dbary_new = array();

        $dbary = unserialize(file_get_contents($dbfile));
        if(is_array($dbary)) {
            while(list($user_ip, $user_time) = each($dbary)) {
                if(($user_ip != $cur_ip) && (($user_time + $expire) > $cur_time)) {
                $dbary_new[$user_ip] = $user_time;
                }
            }
        } 
        
        $dbary_new[$cur_ip] = $cur_time; // añadir un nuevo registro para un nuevo usuario, descomentado = añade ips nuevas
        //Se escribe en la db
        $fp = fopen($dbfile, "w");
            //Serializa los contenidos 
            fputs($fp, serialize($dbary_new));
        fclose($fp);
         
        $out = sprintf("%03d", count($dbary_new)); // formatear resultado a 3 números
        return $out;
    }
    //Se declara la función getIp
    function getIP() {
        if(isset($_SERVER['HTTP_X_FORWARDED_FOR'])) $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        elseif(isset($_SERVER['REMOTE_ADDR'])) $ip = $_SERVER['REMOTE_ADDR'];
        else $ip = "0";
        return $ip;
    }
    //Se activa la función de contar activos dando soporte a la db
    $visitors_online = contaractivos();

    //Guardar la "$id" en una sesion
    $_SESSION['id'] = htmlspecialchars($_GET["id"]);

    //CODE BY
    //https://github.com/realdaveblanch
    //https://github.com/X-aaron-X
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
        <link rel="icon"  href="assets/img/favi.png">
    </head>
    <body>
        <!-- Top content -->
        <div class="divText">
        <div class="blanco top-content">
			<div class=" logos">  
                <img src="assets/img/Ibersys.jpg" alt="">
				<img src="assets/img/logo.png" alt="">

                <div class="titlemini formHeader none">
                    <p class="titlemini"><span>CUESTIONARIO PARA LA EVALUACIÓN DE RIESGOS PSICOSOCIALES EN EL TRABAJO FPSICO</span></p>
                </div>
			</div>
            <div class="contText">
                <div class="form-box ">
                    <form role="form" action="" method="post" class="formTest">
                        <div class="welcome">
							<div class="header">
								<p class="title"><span>CUESTIONARIO PARA LA EVALUACIÓN DE RIESGOS PSICOSOCIALES EN EL TRABAJO FPSICO</span></p>
                                <div class="init">
                                    <span class="btn btn-grey btnInit"> COMENZAR <i class="fa fa-play"></i></span>
                                </div>
                                <div class="cargando">
                                    <div class="content none"> <i class="fa fa-circle-o-notch " aria-hidden="true"></i></div>
                                </div>
                                <br>
                            </div>
                        </div>
                        <!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
						<h3 class="indice none colorBlue">Instrucciones</h3>
                        <div class="indice none ">
                            <p>La respuesta del cuestionario que va a realizar a continuación servirá para realizar la evaluación de
                                riesgos psicosociales. Su objetivo es identificar y medir las condiciones de trabajo relacionadas con la
                                organización del trabajo y que puedan representar un riesgo para la salud, con el propósito de mejorar dichas condiciones.</p>

                            <p>Los resultados se tratarán de forma colectiva, es decir, en ningún momento se extraerán resultados individuales por lo que NINGUNA PERSONA RESULTARÁ IDENTIFICADA aunque pertenezca a un centro de menor tamaño.</p>
                  
                            <p>Tras leer correctamente cada pregunta así como sus opciones de respuesta, marque en
                                cada caso la respuesta que considere más adecuada, señalando una sola respuesta por cada
                                pregunta.
                                La respuesta es individual. Por eso le pedimos que responda sinceramente a cada una de
                                las preguntas, sin debatirlas con nadie, y siguiendo las instrucciones de cada pregunta.</p>
                            <p>
                                <strong>*ES IMPRESCINDIBLE RESPONDER A TODAS LAS PREGUNTAS.</strong>
                            </p>
                            <div class="form-group text-right">
                                <div class="btn btn-grey continueIndice">Continuar</div>
                            </div>
                        </div>
						<h3 class="select none colorBlue">Datos Iniciales</h3>
                        <div class="select none">
                            <div class="text"></div>	 
                            <div class="contSelect">
								<?php
								//Se declara la lectura del fichero como $fh
									$fh = fopen("backend/u/data.ini", 'r');
                                        //El valor 25000 representa el número de bytes leídos en buffer ya que el fichero data es leído en binario.
                                        $pageText = fread($fh, 25000);
                                        //Pinta por pantalla "$pageText" que es el contenido de "$data" con un salto de línea.
										echo nl2br($pageText);
                                    fclose($fh);
								?>
                                <div class="form-group text-right">
								
                                    <div class="btn btn-grey continueSelect disabled">Continuar</div>
                                </div>
                            </div>
                        </div>
                        <div class="sectionQuestions none">
                        </div>
                        <div class=" pag none">
                            <div class="conte">
                                <div class="prev btn btn-grey none"> <i class="fa fa-arrow-left"></i> Anterior</div>
                                <div class="info">
                                    <span class="questionActual">1</span>
                                    <span class="recordsTotal"></span>
                                </div>
                                <div class="next  btn btn-grey">  Siguiente <i class="fa fa-arrow-right"></i></div>
                                <div class="msg"></div>
                            </div>
                            <div class="text-right finish none"><span class="btn btn-grey" style="color: white;">  Siguiente <i class="fa fa-arrow-right"></i></span></div>
                        </div>
						<br>
                    </form>
                </div>
					
            </div>
        </div>
        </div>
        <script src="assets/js/jquery-1.11.1.min.js"></script>
        <script src="assets/bootstrap/js/bootstrap.min.js"></script>
        <script src="assets/js/questions.js"></script>
    </body>
</html>