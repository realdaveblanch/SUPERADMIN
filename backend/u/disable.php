<?php 
$dst = file_get_contents("cfg/urlpura.ini");
$nombreactual = $dst; 
$nombrenuevo = $dst . "_old"; 
rename( $nombreactual, $nombrenuevo);
  
?>