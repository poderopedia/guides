guides
======

Poderopedia Geek Guides

Contenidos
* [Repositorios] (#repositorios)
* [HTML y CSS] (#html-y-css)
* [Javascript] (#javascript)
* [Python] (#python)

## Repositorios

* Documentar desde el inicio el proyecto, indicando las librerías requeridas y cada uno de los pasos de configuración
* Documentar cualquier condición necesaria para el funcionamiento de la aplicación, incluídos CronJobs y variables de ambiente.

## HTML y CSS

* La codificación del archivo HTML debe ser utf-8
* Los IDs de cada elemento debe indicarse utilizando minúsculas y guiones entre palabras ``minusculas-con-guion`` y sin utilizar acentos
* Los nombres de los IDs deben ser consistentes con la jerarquia del DOM y deben nombrarse desde los más general a lo particular ``barra-azul`` y no ``azul-barra``
* Se deben incluir los CCS dentro del minificador utilizando ``response.files.append()``.
* Se debe utilizar fast_download para las URL de ``src`` en los tag ``<IMG>``
* Google Analytics debe ir antes del tag ``</HEAD>`` [?](http://support.google.com/googleanalytics/bin/answer.py?hl=en&answer=174090)
* Poner los modales en el footer.

##Javascript

###General

* Usar indentación de Python (4-espacios) para hacer consistente los IDE y facilitar la lectura del código.
* Los nombres de las variables deben ser en ``minusculas_con_underscore`` y sin acentos
* Las variables estáticas deben ser en ``MAYUSCULAS_CON_UNDERSCORES``, y sin acentos.
* Todas las variables globales deben ser definidas al comienzo del documento.
* Todas las variables deben ser limitadas al contexto usuando ``var``.
* Declarar sólo una variable por línea.
* Finalizar todas las sentencias con puntoycoma.
* Se deben incluir los JS dentro del minificador utilizando ``response.files.append()``.
* Usar espacios después de apertura y antes de cada cierre de llave ``{ }`` o corchete ``[ ]``  
en cada declaración de objetos, funciones y arreglos, por ejemplo: ``{ [ foo ] }``.
* No usar espacios después de cada parátesis circular, por ejemplo: ``if (a>b) {`` y no ``if ( a>b ) {``
* Acceder a las propiedas de una estructura de datos, utilizando la sintaxis de corchetes ``data["propiedad"]`` 
en vez de ``data.propiedad``
* Usar ``===`` en vez de ``==``.[?](http://www.impressivewebs.com/why-use-triple-equals-javascipt/)
* Usar comillas simples ``'strings'`` para strings.


### Librerias

Utilizar preferentemente las siguientes librerias.
* [jQuery](http://jquery.com/)
* [Bootstrap](http://twitter.github.com/bootstrap/)
* [CoffeScript] (http://coffeescript.org/)
* [Modernizr] (http://modernizr.com/) para compatibilidad HTML5 y CSS3

### Sobre Jquery
* Las referencias deben ser cacheadas si son usadas más de una vez. Usar prefijo ``$``, por ejemplo ``var $electrica = $("#electrica");``.
* Restringir las búsquedas al DOM mediante variables previamente cacheadas.

## Python

###Lineamientos
* [PEP8](http://www.python.org/dev/peps/pep-0008/).
* Usar comillas simples ``'strings'`` para strings.
* Utilizar las reglas de internacionalización en todos los proyectos (Flask, Web2py).
* Los settings no deben incluirse en los repositorios.
* Incluir ``# coding: utf8`` al encabezado de los archivos .py

###Otros
* Cuando se verifique que una variable sea null. Utilizar siempre ``if foo is None``, no utilizar ``if !foo`` o if ``foo==0``
* Al almacenar fechas se debe utilizar UTC.
* Cuando se quiera acceder a un elemento de un diccionario utilizar ``get``. Por ejemplo ``os.environ.get('DEPLOYMENT_TARGET', None)``

###Librerías y Frameworks
* Framework web2py o Flask
* Fabric

###Especificos sobre web2py
* Ejecutar sólo una vez la aplicación con ``migrate=True`` en el modelo. Luego siempre hacerlo con ``migrate=False``
* Utilizar modulos y no definir funciones en los modelos.
* Compilar la aplicación utilizando el admin (puede automatizarse via fabric)
* Cachear en Ram todo lo que se pueda. Si es posible utilizar un servidor memcached
* Minificar todo el contenido CSS y JS, utilizando response.files.append()
* Comprimir el contenido estático, utilizando los scripts de web2py.
* No codear demasiadas funciones en un mismo controlador. Es preferible tener controladores con pocas funciones.
* No utilizar el cron de web2py, a menos que sea estrictamente necesario. Es mejor crear un script en fabric o cron de sistema.
* Base de Datos. Si no se modificarán o borraran registros, se debe usar el parametro ``cacheable=True`` junto a ``cache=(cache.ram, xx)``.
* Separar lógicas, no incluir lógica de negocios dentro de las vistas (views).
* Utilizar internacionalización en web2py ``T('string_a_traducir')``.
* Para utilizar las vistas en modo debug agregar el siguiente código en la vista:  
``{{if request.is_local:}}``  
``{{=response.toolbar()}}``  
``{{pass}}``
* Para utilizar response.flash agregar el siguiente código en la vista principal:  
``<div class="flash">{{=response.flash or ''}}</div>``

###Especifícos sobre Flask
* Debe seguir las normas de [NPR app-template](https://github.com/nprapps/app-template).

###GitHub
* El desarrollo de detalles mayores debe ser realizado en ``branch`` separados desde ``develop``. 
Mientras dure su desarrollo debe existir un ``merge`` constante desde ``develop``, 
hasta que el desarrollo esté completo. Una vez completo y testeado el código en ``develop`` debe combinarse con ``master``.
* El branch master debe ser siempre código estable y si se reportan bugs debe hacerse un rollback de inmediato.
* No guardar archivos binarios y ni bases de datos en el repositorio.
* No guardar claves ni archivos de configuración en el repositorio.











