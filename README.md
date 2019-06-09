#PHP Containers Docker

Examples to build or run images, based in php with some extensions enabled
Sometimes it's very dificulty to enable some extensions , this containers will resolve your problem :D

In each folder contain a example to test image, you need docker-compose then just execute the command/actions:
<br />
* 1.0
    * <strong>docker-composer up -d</strong>
* 1.1
    * <strong>unzip</strong> 1.1/config-container/app/oracle-lib.zip
    * <strong>docker-composer up -d</strong>


Versions PHP <br />
<b>5.6 - Apache</b>

----
<strong>Create Vhosts:</strong><br />

   This example based in hosts existing inside folder of builds, but if you need diferent hosts just follow this steps
	
<pre>	
1) - Hosts file:

Where I find this file ? 
	Windows:
		C:\Windows\System32\drivers\etc
	Linux
		/etc/hosts

In your Machine :
	Write new line with  "127.0.0.1	dev.local.com.br"
			
In container folder:
	config-container/app/apache/hosts
	
</pre>

<pre>			
2) - Virtual Hosts Apache
	A example of this can can be found in: config-container\app\apache\sites-available\dev.local.com.br.conf
	Quick explanation:
		ServerName dev.local.com.br - represent the name of your "fake site" create in your hosts file
		DocumentRoot - where the project root folder locate **www-container\app**
		Directory - configuration of project rewrite url....
</pre>

<pre>
3) - Enable your site
	After follow 2 steps, just execute the command
	
	docker exec -it container_name bash
	a2ensite nameyouthost.conf
	service apache2 reload
</pre>

Go to browser Enjoy it ! 