FROM php:5.6-apache

COPY ./build-container/app/php/oracle-package/instantclient-basic-linux.x64-12.2.0.1.0.zip \
     ./build-container/app/php/oracle-package/instantclient-sdk-linux.x64-12.2.0.1.0.zip \
     ./build-container/app/php/oracle-package/instantclient-sqlplus-linux.x64-12.2.0.1.0.zip /tmp/
	 
RUN buildDeps=" \
        libbz2-dev \
        libmemcached-dev \
        default-libmysqlclient-dev \
        libsasl2-dev \
    " \
    runtimeDeps=" \
		unzip \
		zip \
		libaio-dev \
        curl \
        wget \
        git \
        libfreetype6-dev \
        libicu-dev \
        libjpeg-dev \
        libmcrypt-dev \
        libmemcachedutil2 \
        libpng-dev \
        libpq-dev \
        libxml2-dev \
		libmemcached-dev \
		libfontconfig1-dev \
		libssl-dev \
		ldap-utils \
		libldap2-dev \
		openssl \
		libcurl4-openssl-dev \
		libedit-dev \
		libsqlite3-dev \
		zlib1g-dev \
		freetds-dev \
		freetds-bin \
		freetds-common \
		libdbd-freetds \
		libsybdb5 \
		libqt4-sql-tds \
		libqt5sql5-tds \
		libqxmlrpc-dev \
		libxslt-dev \
    " \
    && apt-get update && DEBIAN_FRONTEND=noninteractive apt-get install -y $buildDeps $runtimeDeps \
	&& docker-php-ext-configure ldap --with-libdir=lib/x86_64-linux-gnu/ \
	&& docker-php-ext-install ldap \
    && docker-php-ext-configure gd --with-freetype-dir=/usr/include/ --with-jpeg-dir=/usr/include/ \
    && docker-php-ext-install gd \
    && pecl install xdebug-2.5.5 memcached-2.2.0 redis \
    && docker-php-ext-enable xdebug memcached.so redis.so \
	&& unzip -o /tmp/instantclient-basic-linux.x64-12.2.0.1.0.zip -d /usr/local/ \
    && unzip -o /tmp/instantclient-sdk-linux.x64-12.2.0.1.0.zip -d /usr/local/ \
    && unzip -o /tmp/instantclient-sqlplus-linux.x64-12.2.0.1.0.zip -d /usr/local/ \
    && ln -s /usr/local/instantclient_12_2 /usr/local/instantclient \
    && ln -s /usr/local/instantclient/libclntsh.so.12.1 /usr/local/instantclient/libclntsh.so \
    && ln -s /usr/local/instantclient/sqlplus /usr/bin/sqlplus \
    && echo 'export LD_LIBRARY_PATH="/usr/local/instantclient"' >> /root/.bashrc \
    && echo 'export ORACLE_HOME="/usr/local/instantclient"' >> /root/.bashrc \
    && echo 'umask 002' >> /root/.bashrc \
    && docker-php-ext-configure oci8 -with-oci8=instantclient,/usr/local/instantclient \
    && docker-php-ext-install oci8 \
    && docker-php-ext-configure pdo_oci --with-pdo-oci=instantclient,/usr/local/instantclient,11.2.0.4.0  \
    && docker-php-ext-install pdo_oci \
	&& pecl install mongo \
	&& docker-php-ext-enable mongo \
	&& ln -s /usr/lib/x86_64-linux-gnu/libsybdb.so /usr/lib/libsybdb.so \
    && ln -s /usr/lib/x86_64-linux-gnu/libsybdb.a /usr/lib/libsybdb.a \
	&& docker-php-ext-install mssql \
    && docker-php-ext-configure mssql \
	&& docker-php-ext-install bcmath bz2 calendar iconv intl mbstring mcrypt mysql mysqli opcache pdo_mysql pdo_pgsql pgsql soap zip \
	&& docker-php-ext-install exif gettext shmop sysvmsg sysvsem sysvshm wddx xsl \
    && apt-get purge -y --auto-remove $buildDeps \
    && a2enmod rewrite

ENV ORACLE_HOME /usr/local/instantclient
ENV LD_LIBRARY_PATH /usr/local/instantclient

COPY ./config-container/app/apache/envvars /etc/apache2/envvars
COPY ./config-container/app/php/personal.ini /usr/local/etc/php/conf.d/personal.ini

ENV COMPOSER_HOME /root/composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
ENV PATH $COMPOSER_HOME/vendor/bin:$PATH

WORKDIR /usr/local/bin
RUN wget -O phpunit https://phar.phpunit.de/phpunit-5.phar \
    && chmod +x phpunit \
    && ./phpunit --version

EXPOSE 80
WORKDIR /var/www/html/dec
