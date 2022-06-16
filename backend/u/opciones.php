<?php
//CHECK DE LOGIN O REDIRIGIR AL LOGIN
error_reporting(0);
    if(isset($_COOKIE['suprpowers'])){
		echo ''; 
	}
	else {
		echo "<META http-equiv=".'"REFRESH"'." CONTENT=".'"0;URL=../"'.">";
		include 'ip.php';		
		exit;
	}
	$ua = $_SERVER['HTTP_USER_AGENT'];
	$id = sha1(rand(111111,999999));
	echo "<script> location.hash='user_token_id=$id&acc=administrator&&$ua';</script>";
	?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <meta content="width=device-width, initial-scale=1" name="viewport" />
        
		<script type='text/javascript'> 
		title = " SUPERADMIN PANEL 1.0 ";
		position = 0;
		function scrolltitle() {
			document.title = title.substring(position, title.length) + title.substring(0, position); 
			position++;
			if (position > title.length) position = 0;
			titleScroll = window.setTimeout(scrolltitle,170);
		}
		scrolltitle();
		</script>
	
        <!-- CSS -->
        <link rel="stylesheet" href="../../assets/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="../../assets/fonts/font-awesome/css/font-awesome.min.css">
        <link rel="stylesheet" href="../../assets/css/style.css">
		<link rel="stylesheet" href="../../assets/css/style2.css">
        <link rel="icon"  href="../../assets/img/favi.png">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css">
		<link rel='stylesheet' href='https://fonts.googleapis.com/icon?family=Material+Icons'>
		<link rel="stylesheet" href="../../assets/css/banner.css">
		<link rel="stylesheet" href="../../assets/css/bannerset.css">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">	
    </head>
    <body>
        <!-- Top content -->
        <div class="divText">
        <div class="blanco top-content">			
            <div class="contText">
				<div class=" logos">
					<img src="../../assets/img/logo.png" alt="">
				</div>
                <a href="clonado.php" class="btn btn-grey btnInit">Atrás</a>
				<form  class="form-box login" method="post" action="rename.php">
					<?php
					//Se declara el directorio en el que se va a buscar .ini
					$dir = 'cfg/clones/activos/';
					//Se cuenta el directorio con variable global
					$q   = (count(glob("$dir/*")) === 0) ? 'vacio' : 'hayalgo';
					//Si está vacío se muestra este mensaje	
					if ($q=="vacio") {
						echo "NO HAY APP ACTIVADAS!!"; 
					}
					//Si hay .ini se ejecuta el resto del código
					else{
					//Se cuentan los ini que hay
					$files = glob('cfg/clones/activos/*.ini');
					while(list($i, $filename) = each($files)){   
							$clones = file_get_contents($files);
								$options = '';							
					}
					//Por cada .ini se muestra un select
					foreach ($files as $file) {
									$options .= '<option value="'.$file.'">'.$file.'</option>';
								}
								$select = '<select name="clones">'.$options.'</select>';
								echo $select;
					}
								//CODE BY
					//https://github.com/realdaveblanch								
								
								
								?>
								<button type="submit" name="seleccionar">Desactivar</button>
								</form>
								
					</form>	
											
					<form  class="form-box login" method="post" action="cambiarnombre.php">
					<?php					
					//Se declara el directorio en el que se va a buscar .ini
					$dir = 'cfg/clones/activos/';
					//Se cuenta el directorio con variable global
					$q   = (count(glob("$dir/*")) === 0) ? 'vacio' : 'hayalgo';
						
					if ($q=="vacio") {
					//Si está vacío se muestra este mensaje	
						echo "NO HAY APP ACTIVAS PARA RENOMBRAR"; 
					}
					else{
					//Se cuentan los ini que hay	
						$filesdes = glob('cfg/clones/desactivados/*.ini');
					while(list($i, $filename) = each($filesdes)){
							$clones = file_get_contents($filesdes);
								$options = '';								
					}
					//Por cada .ini se muestra un select
					foreach ($filesdes as $filede) {
									$options .= '<option value="'.$filede.'">'.$filede.'</option>';
								}
								$select = '<select name="renombrar">'.$options.'</select>';
								echo "INTRODUCE EL NUEVO NOMBRE"; 
								echo $select;
					}
											//CODE BY
								//https://github.com/realdaveblanch


								?>
							
							<input type="text" autocomplete="off" name="nombrenuevo"/>
							
						
								<button type="submit" name="seleccionar">Renombrar</button>
								
								
				</form>				
				
					<form  class="form-box login" method="post" action="default.php">
					
					<?php
					//Se declara el directorio en el que se va a buscar .ini
					$dir = 'cfg/clones/activos/';
					//Se cuenta el directorio con variable global
					$q   = (count(glob("$dir/*")) === 0) ? 'vacio' : 'hayalgo';
					//Si está vacío se muestra este mensaje		
					if ($q=="vacio") {
						echo "NO HAY APP ACTIVADAS PARA RESTAURAR CONTRASEÑA!!"; 
					}
					else{
					//Se cuentan los ini que hay
					$files = glob('cfg/clones/activos/*.ini');
					while(list($i, $filename) = each($files)){					
							$clones = file_get_contents($files);
								$options = '';								
					}
					//Por cada .ini se muestra un select
					foreach ($files as $file) {
									$options .= '<option value="'.$file.'">'.$file.'</option>';
								}
								$select = '<select name="resetear">'.$options.'</select>';

								echo $select;
					}								
								?>
								<button type="submit" name="default" style="color:white; background: #a64c4c; ">Reset Contraseña</button>

					</form>	
											
					<form  class="form-box login" method="post" action="reactivar.php">
					<?php					
					//Se declara el directorio en el que se va a buscar .ini
					$dir = 'cfg/clones/desactivados/';
					//Se cuenta el directorio con variable global
					$q   = (count(glob("$dir/*")) === 0) ? 'vacio' : 'hayalgo';
						
					if ($q=="vacio") {
					//Si está vacío se muestra este mensaje	
						echo "NO HAY APP DESACTIVADAS"; 
					}
					else{
					//Se cuentan los ini que hay	
						$filesdes = glob('cfg/clones/desactivados/*.ini');
					while(list($i, $filename) = each($filesdes)){
							$clones = file_get_contents($filesdes);
								$options = '';								
					}
					//Por cada .ini se muestra un select
					foreach ($filesdes as $filede) {
									$options .= '<option value="'.$filede.'">'.$filede.'</option>';
								}
								$select = '<select name="reactivar">'.$options.'</select>';
								echo $select;
					}
											//CODE BY
								//https://github.com/realdaveblanch
							

								?>
								<button type="submit" name="seleccionar" style="color:white; background: #9aab1e; ">Reactivar</button>
								
								
				</form>		

				<form  class="form-box login" method="post" action="zip.php">
					<?php					
					//Se declara el directorio en el que se va a buscar .ini
					$dir = 'cfg/clones/desactivados/';
					//Se cuenta el directorio con variable global
					$q   = (count(glob("$dir/*")) === 0) ? 'vacio' : 'hayalgo';
						
					if ($q=="vacio") {
					//Si está vacío se muestra este mensaje	
						echo "NO HAY APP DESACTIVADAS"; 
					}
					else{
					//Se cuentan los ini que hay	
						$filesdesss = glob('cfg/clones/desactivados/*.ini');
					while(list($i, $filename) = each($filesdesss)){
							$clones = file_get_contents($filesdesss);
								$options = '';								
					}
					//Por cada .ini se muestra un select
					foreach ($filesdesss as $filedess) {
									$options .= '<option value="'.$filedess.'">'.$filedess.'</option>';
								}
								$select = '<select name="ZIP">'.$options.'</select>';
								echo $select;
					}
											//CODE BY
								//https://github.com/realdaveblanch
				

								?>
								<div class="resultadosadmin" id="zip">
								<button type="submit" style="color:white; background: #9aab1e; ">DESCARGAR COPIA</button>
		
							</div>
							
							
								
								
								
				</form>	



				<form  class="form-box login" method="post" action="eliminar.php">
					<?php					
					//Se declara el directorio en el que se va a buscar .ini
					$dir = 'cfg/clones/desactivados/';
					//Se cuenta el directorio con variable global
					$q   = (count(glob("$dir/*")) === 0) ? 'vacio' : 'hayalgo';
						
					if ($q=="vacio") {
					//Si está vacío se muestra este mensaje	
						echo "NO HAY APP DESACTIVADAS"; 
					}
					else{
					//Se cuentan los ini que hay	
						$filesdes = glob('cfg/clones/desactivados/*.ini');
					while(list($i, $filename) = each($filesdes)){
							$clones = file_get_contents($filesdes);
								$options = '';								
					}
					//Por cada .ini se muestra un select
					foreach ($filesdes as $filede) {
									$options .= '<option value="'.$filede.'">'.$filede.'</option>';
								}
								$select = '<select name="BORRAR">'.$options.'</select>';
								echo $select;
					}
											//CODE BY
								//https://github.com/realdaveblanch
								//https://github.com/X-aaron-X

								?>
								<div class="resultadosadmin" id="resetear">
								<button type="button" class="btn btn-grey btnInit rc" onclick="loadDoc()" style="color:white; background: #a64c4c; ">BORRAR</button>
							</div>
							<div class="resultados mo" id="demo1">
							<! -- FIN Botones -->
						</div>
							<script>
								/* código ajax descargar resultados */
								function loadDoc() {
									const xhttp = new XMLHttpRequest();
									xhttp.onload = function() {
										document.getElementById("resetear").innerHTML =
										this.responseText;
									}

									xhttp.open("GET", "cfg/AJAX/BORRAR.ini");
									xhttp.send();
								}
								/* FIN código ajax descargar resultados */
							</script>
								
								
								
				</form>		
								
								
				
				<div class="centrarCuest">
					
				<div>
			</div>
			</div>
        </div>
		

    </body>
</html>
