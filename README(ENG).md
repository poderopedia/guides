## Pixel-Ping

Application that runs on the server, it serves to keep track of the "hits" of an article or website, 
through a little code snippet. 

To install: http://documentcloud.github.com/pixel-ping/

You must insert the following tag in the website that you want to track
``<img src="/pixel.gif?key=[KEY]" alt="" />`` 

It's indicated in the source that a javascript that inserts the tag automatically must be included, avoiding
some problems (http://www.propublica.org/nerds/item/pixel-ping-a-nodejs-stats-tracker).

*To do: Specify which files must be included in the framework.

## Mode

Every once in a configurable time interval, the application sends a JSON to the specified URL.
This has the following form:   
``{ ``  
``"/pages/about.html": 276,``  
``"/articles/policy.html": 324``   
``}``  
The first string indicates the website "key" and the following one the number of hits.

However, the following problem exists: When an external website acquires the pixel-ping snippet, you cannot distinguish
between a hit on the article on the site itself and one on the external site. The proposed solution is that when a 
subject wants to get the snippet, a dialog box will ask for an identification of the source (the URL maybe) and create
a snippet with a "key", made of the "original key item" + "identifier of the other site".

The result will be:

``{``  
``"poderopedia.org|/pages/about.html": 100,``   
``"latercera.cl|/pages/about.html": 176,``   
``"poderopedia.org|/articles/policy.html": 324``   
``}``

That's a parseable compound "key" and the explicit data.

### References and Pixel-Ping guides:
https://github.com/documentcloud/pixel-ping  
http://documentcloud.github.com/pixel-ping/  
http://www.propublica.org/nerds/item/pixel-ping-a-nodejs-stats-tracker  
Utilizado en: http://www.propublica.org/about/pixelping  
http://www.propublica.org/article/who-polices-prosecutors-who-abuse-their-authority-usually-nobody/single#republish

--------------------------------------------------------


## Operation:
The operation works based on 3 files:
* config.json, 
* index.php, 
* database.php, 
* A mysql database, whose structure is defined in the file: script_pixel_ping_db.sql

The table described in the sql file must exist at the execution time.

### config.json:
It must be located in a directory of the server, not accesible through the wer (DO NOT PLACE AT /var/www/ ...)

The pixel-ping configuration file config.json must be correctly configurated.
Example:
<code>  
{  
  "host":     "localhost",  
  "port":     "9187",  
  "interval": 5,  
  "endpoint": "http://localhost/pixel_local_test/index.php"  
}
</code>  

### index.php
It's important to modify the index.php variables to made them compatible with the database.
The file must be located in a place where can be executed by the server
(example /var/www/pixel/index.php)

### database.php
It must be located in the same folder as index.php. Nothing must be modified.

####Execution process
Pixel-ping must be executed on the server, through the pixel-ping command with the location of the file config.json   

#### Example:
<code> /home/user/node-v0.10.3/node_modules/pixel-ping/bin/pixel-ping /home/user/pixel/config.json</code>   


Finally, each time that a request is made to the gif file server by pixel-ping, 
cada vez que se haga un request al archivo gif servido por pixel-ping.  
(Example, in the browser
``http://localhost:9187/pixel.gif?key=sitio.com/restodelkey``  )
pixel-ping will store the data and will send it to index.php in the next flush.
The file index.php receives the flush through a POST as a JSON that describes the hits and stores them
in the database table.

## Pixel-ping as a service:

"Upstart" will be used for the app instalation as a service.
A sample file called "pixel-ping-svc.conf" is included in the repository.
This file contains the script that mantains the service running.
It must be edited to modify the pixel-ping exe command with the correct routes.as correctas.

Once modified, to add pixel-ping as a service, the file "pixel-ping-svc.conf" must be copied to the
server directory <code>/etc/init/</code>.
At this moment, the service it's not running due that the event that starts its execution (described in
the "pixel-ping-svc.conf" file) hasn't been generated.
To manually start it, you must enter the following command in the terminal:
<code> sudo start pixel-ping-svc </code>
This executes the script and pixel-ping runs as a service.
