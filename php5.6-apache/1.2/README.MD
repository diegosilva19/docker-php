<h1>Xdebug</h1>
<p>Remote debug are enabled default in port 9000 , just mapping port on docker-compose.yml</p>

<h1>PHP Unit</h1>
After up process (docker-composer....) , exists a simple application configured phpunit.<br />
Inside of container (path: <b> /var/www/html/app-php-unit </b> ) execute:

* composer install 
* composer run-test


<h1>Oracle Config</h1>


1) Create symbolic link to build **Optional** <br />
     * **Copy folder** /path/build-container/app/php/oracle-package <b>-></b> 1.2/build-container/app/php/oracle-package 
        
2) Create symbolic link oracle-lib to run image **Required**
    * <b>ln -s</b> /your-system-path/build-container/app/php/oracle-lib <b>/your-system-path/php5.6-apache/1.1/config-container/app/oracle-lib</b>
---
3) Unzip files
    * 1.1/config-container/app/oracle-lib.zip
        * unzip oracle-lib.zip
---

4) Map dirs on the docker-compose.yml

* 1.1/config-container/app/php/personal.ini
	* ./config-container/app/php/personal.ini:/usr/local/etc/php/conf.d/personal.ini<br />
		Enable extension=oci8.so;
---
* 1.1/config-container/app/apache/envvars
	* ./config-container/app/apache/envvars:/etc/apache2/envvars <br />
		Contain environment vars to set a directory of oracle client
---		
* 1.1/oracle/config-container/oracle-lib :
	* "./config-container/app/oracle-lib:/usr/local/instantclient_12_2"<br />
		Lib client unziped, necessary configure on docker-compose.yml. 
---		
* Configure TsNames:
    * Just put your file tsname.ora on the directory
        * 1.1\config-container\app\oracle-lib\network\admin\tsname.ora