PHP 5.6 Apache

[PHP Modules]
	bcmath
	bz2
	calendar
	Core
	ctype
	curl
	date
	dom
	ereg
	fileinfo
	filter
	ftp
	gd
	hash
	iconv
	intl
	json
	ldap
	libxml
	mbstring
	mcrypt
	memcached
	mhash
	mongo
	mssql
	mysql
	mysqli
	mysqlnd
	oci8
	openssl
	pcre
	PDO
	pdo_mysql
	PDO_OCI
	pdo_pgsql
	pdo_sqlite
	pgsql
	Phar
	posix
	readline
	redis
	Reflection
	session
	SimpleXML
	soap
	SPL
	sqlite3
	standard
	tokenizer
	xml
	xmlreader
	xmlwriter
	Zend OPcache
	zip
	zlib

[Zend Modules]
	Zend OPcache
	
	
------ Oracle Config
Map dirs on the docker-compose.yml

1.1/config-container/app/php/personal.ini
	- ./config-container/app/php/personal.ini:/usr/local/etc/php/conf.d/personal.ini
		Enable extension=oci8.so;

1.1/config-container/app/apache/envvars
	- ./config-container/app/apache/envvars:/etc/apache2/envvars
		Contain environment vars to set a directory of oracle client
		
1.1/oracle/config-container/oracle-lib :
	- "./config-container/app/oracle-lib:/usr/local/instantclient_12_2"
		Lib client unziped, necessary configure on docker-compose.yml. 
		
	* Configure TsNames:  
		Just put your file tsname.ora on the directory  1.1\config-container\app\oracle-lib\network\admin\tsname.ora