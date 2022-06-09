-----1. CHANGELOG---
10/05/22 - 1.7.0 - AÑADIDO FUNCIONALIDAD CAMBIAR VALOR URL Y SOLUCIÓN DE BUGS
11/05/22 - 1-7-0 - AÑADIDO SUBIR LOGOS Y SOLUCIÓN DE BUGS

Aplicación Web de Realización de Cuestionarios - Ibersys - FPSICO


## 2. Credenciales de acceso


Los usuarios y sus respectivas contraseñas se encuentras ubicadas en el interior del fichero "comprobarLogin.php", ubicado en el directorio "backend", estas pueden ser modificadas con un editor de texto plano.

![alt text](https://github.com/X-aaron-X/adc/blob/main/readme/cambiopassword.png?raw=true)

En este caso los valores que pueden ser editados son los llamados "cliente", "administrador" y "contraseña" por los respectivos valores que se requieran.

## 3. ESPECIFICAR URL EN ADMIN PANEL


Desde el admin panel se especifica cual es la url base del servidor, conocido antiguamente como el valor "$url=/adc?id=".
Al indicar el valor base, esta configuración se verá reflejada en todas las funcionalidades de la plataforma en las que se requiera de este valor y podrá ser modificado en cualquier momento.

El valor actual puede ser visualizado desde el panel de administración en el VALOR URL ACTUAL, destacado por un color azul turquesa.

## 3. Activación de cuestionarios


Accediendo al panel del administrador se encuentra la opción de cúantos cuestionarios se desea desplegar.
Se introduce el número de estos y se hacke click en el botón "crear".
Acto seguido, se debe hacer click en el botón "Activar Cuestionarios" para que de comienzo el despliegue de links únicos y carpetas que guardarán los resultados que generen los usuarios.

## 4. Reseteo de cuestionarios/Reinicio


Accediendo al panel del administrador se encuentra la opción "Reiniciar Cuestionarios" cuya funcionalidad consiste en la eliminación del directorio "res" junto sus contenidos (resultados de las encuentas) para poder comenzar una nueva campaña de cuestionarios.


## 5. Descarga de resultados


Accediendo al panel del administrador o desde el panel de administración del cliente se encuentra la opción "Descargar Resultados", el cual compilará en un sólo fichero los resultados de todos los cuestionarios y los descargará en un fichero "resultados.txt".
Estos resultados no podrán ser descargados después del Reseteo de cuestionarios.


## 6. Menú lateral


El panel del administrador incluye un menú lateral con las opciones "Mostrar Logs" y "Mostrar Resultados" los cuales muestran en pantalla los contenidos del fichero ."log" y los resultados de las encuestas sin necesidad de descarga.


## 7. Menú lateral - SUBIR LOGO CLIENTES


Se permiten subir y eliminar hasta 3 logos de clientes que aparecerán en toda la plataforma.
Se deben subir con el nombre "logo", "logo2 ó "logo3", con extensión png.
Si se pulsa en el botón eliminar logos, la plataforma quedará sólo con el logo de Ibersys.
Si se suben más logos sin haber eliminado los anteriores, estos seráns sobreescritos por los nuevos.


## 8. Consideraciones


!! Los links generados por la aplicación son descartados de los paneles de admnistración una vez la encuesta ha sido rellenada, mostrando los cuestionarios que todavía no han sido completados y se encuentran disponibles para los usuarios.

!! Las funcionalidades Listado y Descarga de Resultados NO funcionarán si no se encuentran activados lo cuestionarios con anterioridad.


!! Es muy importante tener en cuenta que algunos de los cambios que se realizen desde el admin panel, pueden no ser visualizados correctamente debido a la caché, esto puede solucionarse abriendo una pestaña en incógnito o cerrando el navegador.


## Autores

- [@X-aaron-X](https://github.com/X-aaron-X)
- [@realdaveblanch](https://github.com/realdaveblanch)

