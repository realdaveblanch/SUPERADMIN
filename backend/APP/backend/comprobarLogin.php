<?php 
  if ($_SERVER["REQUEST_METHOD"]=="POST"){
    header('Location: ' . $_SERVER['HTTP_REFERER']); 
    //Cogemos los valores del formulario y los pasamos a unas variables
    $usuario = $_POST["usuario"];
    $pass = $_POST["pass"];

    $cliente = file_get_contents('u/cfg/ssap/ssapetnecli.ini');
    $ad = file_get_contents('u/cfg/ssap/ssapnimda.ini');
    
    //Credenciales del panel de administrador.
    if($usuario == "admin" and $pass == trim($ad) ){
      session_start(); 
      //Se añade la zona horaria actual para el admin
      date_default_timezone_set("Europe/Madrid");
      //Se le añade una cookie de 3 meses (para el banner de last login, no sirve para logearse)
      $timeframe = 90 * 60 * 24 * 60 + time();
      
      setcookie('lastVisit', date("G:i - m/d/y"), $timeframe,'/');
      //Se le añade una cookie de 2 horas para logearse, se crea de forma aleatoria
      $random= rand(0, 9999999);
      $idlol = sha1(rand(111111,999999));
      //Se asigna un cookie al inicio de sesion del administrador
      setcookie('user_name', $idlol, time() + (7200), "/");
      //la cookie expira a las 2 horas y la sesión será destruida automáticamente
      // login correcto, redirigir al panel admin
      header('Location:' . 'u/ad.php'); 
      exit();
    }
    //Credenciales del panel del cliente.
    elseif($usuario == "ibersys" and $pass == trim($cliente)){
      session_start(); 
      //Se asigna un cookie al inicio de sesion del cliente
      $random= rand(0, 9999999);
      $idlol = sha1(rand(111111,999999));

      //Se asigna un cookie al inicio de sesion del cliente
      setcookie('client', $idlol, time() + (7200), "/"); 
      //la cookie expira a las 2 horas y la sesión será destruida automáticamente
      //login correcto, redirigir al panel admin
      header('Location:' . 'listado.php'); 
      exit();
    }
    else{
      header ("location: loginError.php");
    }
  }
?>