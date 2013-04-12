Pixel-Ping

Aplicación que corre en el servidor, y sirve para llevar registro de los "hits" de un artículo o página web, a partir de un pequeño snippet de código. Para instalar: http://documentcloud.github.com/pixel-ping/

En la página en la que se requiere llevar registro de hits, se debe insertar el tag <img src="/pixel.gif?key=[KEY]" alt="" /> en la pagina. En una fuente(http://www.propublica.org/nerds/item/pixel-ping-a-nodejs-stats-tracker) indican que se debe incluir un scrip javascript que inserta el tag automáicamente, evitando algunos problemas.

*Por hacer: especificar qué archivos se deben incluir en el framework para que funcione Pixel-Ping.

Cada cierto intervalor de tiempo (configurable), la aplicación envía un json a la url especificada. Este tiene la siguiente forma: { "/pages/about.html": 276, "/articles/policy.html": 324 } donde el primer string indica el "key" de la página, seguido por el número de hits.

El primer problema es que, luego de que una página externa adquiera el snippet de nuestro pixel-ping, y que ssea efectivamente utilizado, no se podrá distinguir entre un hit en el artículo en el sitio propio, y uno en el sitio externo. La solución propuesta consiste en que cuando un interesado quiera obtener el snippet de nuestro pixel-ping, un cuadro de dialogo le pida una identificacion de la fuente(puede ser la url agena), y a partir de eso, generar un snippet con un "key" compuesto del "key original del articulo" + "identificador del sitio tercero". Así se obtendría algo como:

{ "poderopedia.org|/pages/about.html": 100, "latercera.cl|/pages/about.html": 176, "poderopedia.org|/articles/policy.html": 324 }

Y así queda un key compuesto parseable, y los origenes de los datos explícitos.

Referencias y guias de Pixel-Ping:
https://github.com/documentcloud/pixel-ping
http://documentcloud.github.com/pixel-ping/
http://www.propublica.org/nerds/item/pixel-ping-a-nodejs-stats-tracker
Utilizado en: http://www.propublica.org/about/pixelping
http://www.propublica.org/article/who-polices-prosecutors-who-abuse-their-authority-usually-nobody/single#republish

Funcionamiento:
El funcionamiento actual se basa en 3 archivos:
config.json, index.php, database.php

y una base de datos mysql.
Script en el archivo: script_pixel_ping_db.sql

- config.json:
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
- index.php
Se debe modifcar tambien las variables del archivo index.php para que coincidan con la base de datos.
El archivo se debe ubicar en algun lugar en el que el servidor pueda ejecutarlo (ejemplo /var/www/pixel/index.php)

- database.php
Debe ir en la misma carpeta que index.php. No se debe modificar nada.

Proceso de ejecución.

Se debe correr pixel-ping en el servidor, pasando al comando pixel-ping la ubicacion del archivo config.json
Ejemplo: <code> /home/user/node-v0.10.3/node_modules/pixel-ping/bin/pixel-ping /home/user/pixel/config.json</code>

Finalmente, cada vez que se haga un request al archivo gif servido por pixel-ping (ejemplo, en el browser: http://localhost:9187/pixel.gif?key=sitio.com/restodelkey ), pixel-ping acumulará la información y la enviará a index.php en el siguiente flush. index.php recibe el flush a traves de un POST como un json que describe los hits, y los guarda en la tabla de la base de datos.


