<?php
if ($_SERVER["REQUEST_METHOD"] == "POST"){
		//Guardo el valor  "numIDs" introducido en el formulario "ad.php" y lo guardo en $numIDs

}
$clon = $_POST['reactivar'];	


$word = "_old";
$mystring = $clon;
 
// Test if string contains the word 
if(strpos($mystring, $word) !== false){
	$a = substr($clon, 0, -4);
	rename($clon, $a );
//QUITAR PUT CONTENTS	
	
	
	$key = $a;
$contents = '';
$fc=file("cfg/urlunactive.ini");
 foreach($fc as $line)
  {
    if (!strstr($line,$key))
    {
       $contents .= $line; 
     }  
  }
  file_put_contents('cfg/urlunactive.ini',$contents);
  $fp4 = fopen('cfg/urlselect.ini', 'a');
	fwrite($fp4, $a);
  
  
	echo "<META http-equiv=".'"REFRESH"'." CONTENT=".'"2;URL=ok.php"'.">";
} else{
    echo "No está inactivo!";
	echo "<META http-equiv=".'"REFRESH"'." CONTENT=".'"2;URL=fail.php"'.">";
}


?>