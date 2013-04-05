Pixel-Ping

Aplicación que corre en el servidor, y sirve para llevar registro de los "hits" de un artículo o página web, a partir de un pequeño snippet de código.
Para instalar: http://documentcloud.github.com/pixel-ping/

En la página en la que se requiere llevar registro de hits, se debe insertar el tag 
<img src="/pixel.gif?key=[KEY]" alt="" />
en la pagina. En una fuente(http://www.propublica.org/nerds/item/pixel-ping-a-nodejs-stats-tracker) indican que se debe incluir un scrip javascript que inserta el tag automáicamente, evitando algunos problemas.

*Por hacer: especificar qué archivos se deben incluir en el framework para que funcione Pixel-Ping.

Cada cierto intervalor de tiempo (configurable), la aplicación envía un json a la url especificada. Este tiene la siguiente forma:
{
  "/pages/about.html":      276,
  "/articles/policy.html":  324
}
donde el primer string indica el "key" de la página, seguido por el número de hits.

El primer problema es que, luego de que una página externa adquiera el snippet de nuestro pixel-ping, y que ssea efectivamente utilizado, no se podrá distinguir entre un hit en el artículo en el sitio propio, y uno en el sitio externo.
La solución propuesta consiste en que cuando un interesado quiera obtener el snippet de nuestro pixel-ping, un cuadro de dialogo le pida una identificacion de la fuente(puede ser la url agena), y a partir de eso, generar un snippet con un "key" compuesto del "key original del articulo" + "identificador del sitio tercero". Así se obtendría algo como:

{
  "poderopedia.org|/pages/about.html":      100,
  "latercera.cl|/pages/about.html":      176,
  "poderopedia.org|/articles/policy.html":  324
}

Y así queda un key compuesto parseable, y los origenes de los datos explícitos.


Referencias y guias de Pixel-Ping:
https://github.com/documentcloud/pixel-ping
http://documentcloud.github.com/pixel-ping/
http://www.propublica.org/nerds/item/pixel-ping-a-nodejs-stats-tracker
Utilizado en:
http://www.propublica.org/about/pixelping
http://www.propublica.org/article/who-polices-prosecutors-who-abuse-their-authority-usually-nobody/single#republish
