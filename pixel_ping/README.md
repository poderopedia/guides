## Pixel-Ping

Aplicación que corre en el servidor que sirve para llevar registro de los "hits" de un artículo o página web. 
Esto se hace a partir de un pequeño snippet de código. 

Instalación: http://documentcloud.github.com/pixel-ping/

Para llevar el registro de hits de una página se debe insertar el tag 
``<img src="/pixel.gif?key=[KEY]" alt="" />`` en esta. 
En la fuente (http://www.propublica.org/nerds/item/pixel-ping-a-nodejs-stats-tracker) se indica que se debe incluir 
un script de javascript que inserta el tag automáticamente, evitando algunos problemas.

*Por hacer: especificar qué archivos se deben incluir en el framework para que funcione Pixel-Ping.

## Modo de operación  

Cada cierto intervalo de tiempo configurable, la aplicación envía un JSON a la URL especificada. 
Este tiene la siguiente forma:   
``{ ``  
``"/pages/about.html": 276,``  
``"/articles/policy.html": 324``   
``}``  
Donde el primer string indica el "key" de la página, seguido por el número de hits.

Sin embargo se tiene el problema de que, luego de que una página externa adquiera el snippet de nuestro pixel-ping 
y que sea efectivamente utilizado, no se podrá distinguir entre un hit en el artículo en el sitio propio, 
y uno en el sitio externo. La solución propuesta consiste en que cuando un interesado quiera obtener el snippet 
de nuestro pixel-ping, un cuadro de dialogo le pida una identificacion de la fuente(puede ser la URL ajena), 
y a partir de eso, generar un snippet con un "key" compuesto del "key original del articulo" + "identificador 
del sitio tercero".   

De esta manera, se obtendría:   


``{``  
``"poderopedia.org|/pages/about.html": 100,``   
``"latercera.cl|/pages/about.html": 176,``   
``"poderopedia.org|/articles/policy.html": 324``   
``}``

Así queda un "key" compuesto parseable y los origenes de los datos explícitos.

### Referencias y guias de Pixel-Ping:  
https://github.com/documentcloud/pixel-ping  
http://documentcloud.github.com/pixel-ping/  
http://www.propublica.org/nerds/item/pixel-ping-a-nodejs-stats-tracker  
Utilizado en: http://www.propublica.org/about/pixelping  
http://www.propublica.org/article/who-polices-prosecutors-who-abuse-their-authority-usually-nobody/single#republish

--------------------------------------------------------


## Funcionamiento:
El funcionamiento actual se basa en 3 archivos:
* config.json, 
* index.php, 
* database.php, 
* Una base de datos mysql, cuya estructura está definidad via script en el archivo: script_pixel_ping_db.sql

La tabla descrita por el archivo sql debe existir al momento de la ejecución.

### config.json:
Debe estar en algun directorio del equipo, al cual no se tenga acceso a través de la web (NO PONERLO EN /var/www/ ...)

Se debe configurar correctamente el archivo de configuracion de pixel-ping config.json.
Ejemplo:
<code>  
{  
  "host":     "localhost",  
  "port":     "9187",  
  "interval": 5,  
  "endpoint": "http://localhost/pixel_local_test/index.php"  
}
</code>  

### index.php
También se deben modifcar las variables del archivo index.php para que coincidan con la base de datos.
El archivo debe ubicarse en algún lugar en el que pueda ser ejecutado por el servidor 
(ejemplo /var/www/pixel/index.php)

### database.php
Debe ir en la misma carpeta que index.php. No se debe modificar nada.  

####Proceso de ejecución.
Se debe correr pixel-ping en el servidor, pasando al comando pixel-ping la ubicacion del archivo config.json   

#### Ejemplo:    
<code> /home/user/node-v0.10.3/node_modules/pixel-ping/bin/pixel-ping /home/user/pixel/config.json</code>   


Finalmente, cada vez que se haga un request al archivo gif servido por pixel-ping.  
(Ejemplo, en el browser: 
``http://localhost:9187/pixel.gif?key=sitio.com/restodelkey``  )
pixel-ping acumulará la información y la enviará a index.php en el siguiente flush. 
index.php recibe el flush a traves de un POST como un json que describe los hits, 
y los guarda en la tabla de la base de datos.

## Pixel-ping como servicio:

Se utilizará "Upstart" para la "instalación" de la aplicacion como un servicio.
En el repositorio, se incluye un archivo de muestra llamado "pixel-ping-svc.conf".
Este archivo contiene el script que mantiene el servicio en ejecución.
Se debe editar para modificar el comando de ejecución de pixel-ping con las rutas correctas.

Una vez modificado, para agregar pixel-ping como servicio, se debe copiar el archivo
"pixel-ping-svc.conf" al directorio <code>/etc/init/</code> del servidor.
En este momento, el servicio no está corriendo, debido a que el evento desencadena su
ejecución (descrito en el archivo de "pixel-ping-svc.conf") no ha sido generado.
Para iniciarlo manualmente se debe ingresar el siguiente comando en el terminal:
<code> sudo start pixel-ping-svc </code>
De esta manera se ejecuta el script, y pixel-ping queda en ejecución como servicio.
