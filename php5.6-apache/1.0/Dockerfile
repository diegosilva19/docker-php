FROM php:5.6-apache

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
    " \
    && apt-get update && DEBIAN_FRONTEND=noninteractive apt-get install -y $buildDeps $runtimeDeps \
	&& docker-php-ext-configure ldap --with-libdir=lib/x86_64-linux-gnu/ \
	&& docker-php-ext-install ldap \
    && docker-php-ext-configure gd --with-freetype-dir=/usr/include/ --with-jpeg-dir=/usr/include/ \
    && docker-php-ext-install gd \
    && pecl install memcached-2.2.0 redis \
    && docker-php-ext-enable memcached.so redis.so \
	&& pecl install mongo \
	&& docker-php-ext-enable mongo \
	&& ln -s /usr/lib/x86_64-linux-gnu/libsybdb.so /usr/lib/libsybdb.so \
    && ln -s /usr/lib/x86_64-linux-gnu/libsybdb.a /usr/lib/libsybdb.a \
	&& docker-php-ext-install mssql \
    && docker-php-ext-configure mssql \
	&& docker-php-ext-install bcmath bz2 calendar iconv intl mbstring mcrypt mysql mysqli opcache pdo_mysql pdo_pgsql pgsql soap zip \
    && apt-get purge -y --auto-remove $buildDeps \
    && a2enmod rewrite
	
ENV COMPOSER_HOME /root/composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
ENV PATH $COMPOSER_HOME/vendor/bin:$PATH