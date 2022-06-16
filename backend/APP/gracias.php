<?php 
    session_start(); 
    //Se abre la variable global sessionstart
    if ( isset( $_SESSION['cuestionario'] ) ) {
    	unset( $_SESSION['cuestionario'] );
    }
    //Se carga cualquier sesión o cookie con el valor cuestionario
    if (isset($_SERVER['HTTP_COOKIE'])) {
        $cookies = explode(';', $_SERVER['HTTP_COOKIE']);
        foreach($cookies as $cookie) {
            $parts = explode('=', $cookie);
            $name = trim($parts[0]);
            setcookie($name, '', time()-10000);
            setcookie($name, '', time()-10000, '/');
        }
    }

    unset($_COOKIE['cuestionario']);  
    session_destroy();

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
    			</div>
            </div>
        </div>
        <div class="contText">
            <div class="form-box ">
                <div class="desp">
                    Gracias por su colaboración, el cuestionario ha finalizado correctamente.
                </div>   
            </div>
        </div>
    </body>
</html>