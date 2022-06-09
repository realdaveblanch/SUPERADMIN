<?php
//CHECK DE LOGIN O REDIRIGIR AL LOGIN
    if(isset($_COOKIE['suprpowers'])){
		echo ''; 
	}
	else {
		echo "<META http-equiv=".'"REFRESH"'." CONTENT=".'"0;URL=../"'.">";
		include 'ip.php';		
		exit;
	}
echo "Preparando copiado <br/>";
flush();
sleep(0);
echo "...";
sleep(0);
echo "...";
echo "<br/>";
flush();
sleep(0);
echo "....";
echo "<br/>";
flush();
sleep(0);
//Se declaran donde están los valores de url actual
$src = file_get_contents("cfg/urlpura.ini");
//Se declara donde esta el destino
$dst = file_get_contents("cfg/urlclonar.ini");
//Se declaran donde están los valores url 
$file = 'cfg/urldefault.ini';
//Destino del valor url HACIA la carpeta clonada
$newfile = $dst . '/backend/u/cfg/url.ini';
if (is_dir($dst)) {
    echo "FALLO, DIRECTORIO YA EXISTE";
	echo "<META http-equiv=".'"REFRESH"'." CONTENT=".'"0;URL=fail.php"'.">";
exit();	
}
sleep(1);
flush();
echo "<br/>";
echo "-------------------------------<br/>";
echo "Ruta source:", $src;
echo "<br/>";
echo "-------------------------------<br/>";
flush();
echo "Ruta dest:", $dst;
echo "<br/>";
echo "-------------------------------<br/>";
flush();
echo "Final:", $file;
echo "<br/>";
echo "-------------------------------<br/>";
echo "hostname:", $newfile;
echo "<br/>";
sleep(1);
echo "-------------------------------";
echo "<br/>";
echo "COMENZANDO CLONADO POR FAVOR ESPERE......";
echo "<br/>";
sleep(1);
//Se crea función copiado 
function custom_copy($src, $dst) {
	// abrir directorio de principal
	$dir = opendir($src);
	// hacer el destino si no existe
	@mkdir($dst);
	// Loop de forma recursiva todos los archivos del dir principal
	while( $file = readdir($dir) ) {
		if (( $file != '.' ) && ( $file != '..' )) {
			if ( is_dir($src . '/' . $file) )
			{
				// Llamando funcion copiar de forma recursiva 
				custom_copy($src . '/' . $file, $dst . '/' . $file);	
			}
			else {
				copy($src . '/' . $file, $dst . '/' . $file);
			}
		}
	}
	closedir($dir);
}
//Se ejecuta la función de copiado 
custom_copy($src, $dst);

//Se define el string principal
$mainstr = $dst;
//El output antes de transformar los valores
echo "-------------------------------<br/>";
echo "Configurando banner:".$mainstr;
echo "<br/>";
flush();
//Se invoca la función
$replacestr = rm_special_char($mainstr);
//Se define la función
function rm_special_char($str) {
//Eliminar .. y / 
$result = str_replace( array("..", "/"), '', $str);
//El output después de transformar
echo "-------------------------------<br/>";
echo "Banner=:".$result;
flush();
//Se guarda en un fichero temporal
$fp4 = fopen('cfg/hostnametemp.ini', 'a');
file_put_contents('cfg/hostnametemp.ini','', LOCK_EX);
fwrite($fp4, $result);
}

//Proceso de copiado del valor url nuevo para el clonado nuevo
//Si la copia falla, fail
echo "<br/>";
echo "-------------------------------<br/>";
echo "Configurando";
echo "<br/>";
echo "-------------------------------<br/>";
flush();
if (!copy($file, $newfile)) {
    echo "COPIA FALLIDA";
}
//Proceso de copiado del valor hostname nuevo para el clonado nuevo
//Si la copia falla, fail
$fp5 = 'cfg/hostnametemp.ini';
$newfilehost = $dst . '/backend/u/cfg/hostname.ini';
if (!copy($fp5, $newfilehost)) {
	echo "<br/>";
	echo "-------------------------------<br/>";
    echo "COPIA HOSTNAME FALLIDA";
}
//Se escribe el nuevo clon a clones.ini

$fp6 = fopen('cfg/clones.ini', 'a');
file_put_contents('cfg/clones.ini', $dst . "/backend" . "\r\n", FILE_APPEND | LOCK_EX);
$nombreini = file_get_contents('cfg/hostnametemp.ini', 'a');
file_put_contents('cfg/clones/activos/' . $nombreini . ".ini" , $dst);
ob_end_clean();
sleep(1);
echo "<br/>";
flush();
echo "-------------------------------<br/>";
echo "Limpiando...";
//Se elimina el hostname temporal
if (is_file("cfg/hostnametemp.ini")) {
		unlink('cfg/hostnametemp.ini');
	}
echo "<META http-equiv=".'"REFRESH"'." CONTENT=".'"2;URL=ok.php"'.">";
?>
