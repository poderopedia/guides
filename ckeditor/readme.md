Hacer que el plugin web2py ckeditor funcione con SQLFORM.grid <br>
Ejemplos basados en proyecto plug_and_play.<br><br>
I. <br>
INCLUIR ckeditor.js
<br><br>
Hay 2 alternativas: incluir via python, o de la forma clásica javascript.
Utilice la que no cause problemas (errores en la consola).

1. Via python.
En la vista que extiende '_index.html', que inicia con:
<code>
{{extend '_index.html'}}
</code>
en donde se hacen los llamados Ajax para mostrar el formulario(SQLFORM.grid)
correspondiente, se debe agregar el siguiente bloque, inmediatamente luego
anterior:
<pre>
<code>
{{
response.files.insert(0,URL('static','plugin_ckeditor/ckeditor_basic.js'))
response.include_meta()
response.include_files()
}}
</code></pre>

Quedando el inicio del archivo de la siguiente forma:
<pre><code>
{{extend '_index.html'}}
{{
response.files.insert(0,URL('static','plugin_ckeditor/ckeditor_basic.js'))
response.include_meta()
response.include_files()
}}
</code></pre>
(Ver ejemplo: "views/desktop/admin_desktop.html")<br>
<br>
2. Forma clásica javascript
En cualquier archivo de la vista donde se utilizará ckeditor, agregar lo siguiente:
<pre><code> &lt;script type="text/javascript" src="{{=URL(request.application,'static','plugin_ckeditor/ckeditor_basic.js')}}"&gt;
&lt;/script&gt; </code></pre>
<br>
<hr>
<br>

II. 
Incluir la siguiente funcion javascript, por ejemplo, en el archivo "views/_index.html"
si se requiere que esté disponible para todas las vistas.
<pre>
<code>
&lt;body&gt;
   ... resto de "body"
   &lt;!-- Bloque Ckeditor --&gt;
        &lt;script type="text/javascript"&gt;
            function deleteCKEditorInstances() {
                //Necesario para que funcione el plugin ckeditor en los grids
                //El siguiente bloque "recarga" los widgets CKEditor. (en realidad, los elimina,  el plugin los recarga luego)
                if (CKEDITOR && CKEDITOR.instances) {
                    for (var oldName in CKEDITOR.instances) {
                        //en la página de donde se sacó el código, se realiza un cambio de nombres
                        //source: http://stackoverflow.com/questions/1794219/ckeditor-instance-already-exists
                        //como utilizamos un plugin, la utilizacion no es la misma, y parece ser innecesario
                        //var newName = "ajax"+oldName;
                        //CKEDITOR.instances[newName] = CKEDITOR.instances[oldName];
                        //CKEDITOR.instances[newName].name = newName;
                        delete CKEDITOR.instances[oldName];
                    }
                }
                //el bloque anterior, en funcionalidad es equivalente a 
                //CKEDITOR.instances = new Array();
                //pero pareciera mas apropiado en cuanto al manejo de memoria
            }
        &lt;/script>
        &lt;!-- END Bloque Ckeditor --&gt;
&lt;/body&gt;
</code></pre>
<br>
<hr>
<br>

III.
Al final de las vistas llamadas vía ajax, agregar el siguiente llamado<br>
a la funcion javascript (definida en "views/_index.html")
<pre>
<code>
&lt;script type="text/javascript"&gt;
    deleteCKEditorInstances();
&lt;/script&gt;
</code>
</pre>
(ver ejemplo: "views/desktop/display_persona.load")
