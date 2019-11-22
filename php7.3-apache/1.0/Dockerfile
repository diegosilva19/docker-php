FROM php:7.3-apache

###################Apenas para Debian Strech

ENV ACCEPT_EULA=Y

# Microsoft SQL Server Prerequisites
RUN apt-get update \
    && apt-get install -y curl gnupg2 \
    && curl https://packages.microsoft.com/keys/microsoft.asc | apt-key add - \
    && curl https://packages.microsoft.com/config/debian/9/prod.list \
        > /etc/apt/sources.list.d/mssql-release.list \
    && apt-get install -y --no-install-recommends \
        locales \
        apt-transport-https \
    && echo "en_US.UTF-8 UTF-8" > /etc/locale.gen \
    && locale-gen \
    && apt-get update \
    && apt-get -y --no-install-recommends install \
        unixodbc-dev \
        msodbcsql17

# + linhas de instalacao de pecl sql server e xdebug		
###################Apenas para Debian Strech

###Phaton JS #Bug routines:DLFCN_LOAD:could  - erro ssl na lib libfontconfig1-dev
### https://stackoverflow.com/questions/53355217/genymotion-throws-libssl-conf-so-cannot-open-shared-object-file-no-such-file-o
ENV OPENSSL_CONF=/etc/ssl/

RUN buildDeps=" \
        libbz2-dev \
        libmemcached-dev \
        default-libmysqlclient-dev \
        libsasl2-dev \
    " \
    runtimeDeps=" \
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
		libc-client-dev \
		libkrb5-dev \
		libcurl3-gnutls \
		apt-transport-https \
		ca-certificates \
		zip \
		libzip-dev \
    " \
    && apt-get update && DEBIAN_FRONTEND=noninteractive apt-get install -y $buildDeps $runtimeDeps \
    && docker-php-ext-install bcmath json ftp bz2 calendar iconv intl mbstring mysqli opcache pdo_mysql pdo_pgsql pgsql soap fileinfo sockets \
	&& docker-php-ext-configure zip --with-libzip \
	&& docker-php-ext-install zip \
	&& docker-php-ext-configure imap --with-kerberos --with-imap-ssl \
    && docker-php-ext-install imap \
    && docker-php-ext-configure gd --with-freetype-dir=/usr/include/ --with-jpeg-dir=/usr/include/ \
    && docker-php-ext-install gd \
    && pecl install sqlsrv pdo_sqlsrv xdebug \
    && docker-php-ext-enable sqlsrv pdo_sqlsrv xdebug \
    && apt-get purge -y --auto-remove $buildDeps \
    && a2enmod rewrite \
	&& apt-get install -y --no-install-recommends libfontconfig1-dev
		#biblioteca necessaria para rodar o phatomjs ja compilado baixado do site offical 

#libc-client-dev libkrb5-dev  -- extensao imap do php		 ( instalada a mais -> libc-client2007e-dev)
#libcurl3-gnutls apt-transport-https ca-certificates  necessario para instalar sqlsrv

#obs debian strech para jessie
# default-libmysqlclient-dev  (Strech = Debian 9) -> libmysqlclient-dev (jessie = Debian 8)
# libpng-dev  (Strech) -> libpng16-dev(jessie)


#correcao data e hora SP / Brasil
RUN echo "America/Sao_Paulo" > /etc/timezone
RUN dpkg-reconfigure -f noninteractive tzdata


ENV COMPOSER_HOME /root/composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
ENV PATH $COMPOSER_HOME/vendor/bin:$PATH
