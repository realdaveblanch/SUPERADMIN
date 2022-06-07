<?php 
session_start(); 
if ( isset( $_SESSION['bien'] ) ) unset( $_SESSION['bien'] );
if (isset($_SERVER['HTTP_COOKIE'])) {
    $cookies = explode(';', $_SERVER['HTTP_COOKIE']);
    foreach($cookies as $cookie) {
        $parts = explode('=', $cookie);
        $name = trim($parts[0]);
        setcookie($name, '', time()-10000);
        setcookie($name, '', time()-10000, '/');
    }
}
unset($_COOKIE['user_name']);  
unset($_COOKIE['lastVisit']);  
session_destroy(); 
header('Location:' . '../index.php'); 
?>