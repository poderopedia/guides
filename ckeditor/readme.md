Hacer que el plugin web2py ckeditor funcione con SQLFORM.grid

En la vista que extiende '_index.html'
<code>
{{extend '_index.html'}}
</code>
en donde se hacen los llamados Ajax para mostrar el formulario(SQLFORM.grid)
correspondiente, se debe agregar el siguiente bloque, inmediatamente luego
anterior:
<code>
{{
response.files.insert(0,URL('static','plugin_ckeditor/ckeditor_basic.js'))
response.include_meta()
response.include_files()
}}
</code>
Quedando el inicio del archivo de la siguiente forma:
<code>
{{extend '_index.html'}}
{{
response.files.insert(0,URL('static','plugin_ckeditor/ckeditor_basic.js'))
response.include_meta()
response.include_files()
}}
</code>
