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
//Borra la carpeta "temp" y su contenido
	$folderName = 'temp/';
	removeFiles($folderName);

	//La funcion borrara la carpeta res y todo su contenido
	function removeFiles($target) {
	    if(is_dir($target)){
	        $files = glob( $target . '*', GLOB_MARK );
	        foreach( $files as $file ){
	            removeFiles( $file );      
	        }
	        rmdir( $target );
	    } elseif(is_file($target)) {
	        unlink( $target );  
	    }
	}
if ($_SERVER["REQUEST_METHOD"] == "POST"){
		//Guardo el valor  "numIDs" introducido en el formulario "ad.php" y lo guardo en $numIDs
		
		$clon = $_POST['ZIP'];

		$interno = file_get_contents($clon);
		//Se crea temp
@mkdir(temp);
$directorio = $interno . '_old';

$char = '.' . '/';
$nombre = trim($interno, $char);
$zip_file = $nombre . '.zip';


$the_folder = $dir;
$zip_file_name = $zip_file;

class FlxZipArchive extends ZipArchive 
{
 public function addDir($location, $name) 
 {
       $this->addEmptyDir($name);
       $this->addDirDo($location, $name);
 } 
 private function addDirDo($location, $name) 
 {
    $name .= '/';
    $location .= '/';
    $dir = opendir ($location);
    while ($file = readdir($dir))
    {
        if ($file == '.' || $file == '..') continue;
        $do = (filetype( $location . $file) == 'dir') ? 'addDir' : 'addFile';
        $this->$do($location . $file, $name . $file);
    }
 } 
}

$the_folder = $directorio;
$predir = 'temp/';
$zip_file_name = $predir . $nombre . '.zip';
$za = new FlxZipArchive;
$res = $za->open($zip_file_name, ZipArchive::CREATE);
if($res === TRUE) 
{
    $za->addDir($the_folder, basename($the_folder));
    $za->close();
}
else{
echo 'No se pudo crear el archivo zip';
}
header('Location:' .$zip_file_name);

}

echo "<META http-equiv=".'"REFRESH"'." CONTENT=".'"0;URL=opciones.php"'.">";

								//CODE BY
					//https://github.com/realdaveblanch

?>