<?php
if ($_SERVER["REQUEST_METHOD"] == "POST"){
		//Guardo el valor  "numIDs" introducido en el formulario "ad.php" y lo guardo en $numIDs
		
		$clon = $_POST['clones'];	
rename($clon, $clon . "_old");
//Se escribe en urlunactive, que este clon ha sido desactivado
$fp4 = fopen('cfg/urlunactive.ini', 'a');
	fwrite($fp4, $clon . "_old");
	
//Se busca la línea en el select y se elimina

	$key = $clon;
$contents = '';
$fc=file("cfg/urlselect.ini");
 foreach($fc as $line)
  {
    if (!strstr($line,$key))
    {
       $contents .= $line; 
     }  
  }
  file_put_contents('cfg/urlselect.ini',$contents);
  
	echo "<META http-equiv=".'"REFRESH"'." CONTENT=".'"0;URL=ok.php"'.">";
}
else {
	echo "<META http-equiv=".'"REFRESH"'." CONTENT=".'"0;URL=fail.php"'.">";
}


 
?>