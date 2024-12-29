# Imagem base com PHP e Apache
FROM php:8.1-apache

# Instalar dependências necessárias (PDO, MySQL, Git, Xdebug, etc.)
RUN apt-get update && apt-get install -y \
    libpq-dev \
    git \
    unzip \
    && docker-php-ext-install pdo pdo_mysql pdo_pgsql \
    && pecl install xdebug \
    && docker-php-ext-enable xdebug

# Habilitar mod_rewrite para o Apache
RUN a2enmod rewrite

# Instalar o Composer (gerenciador de dependências PHP)
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Definir diretório de trabalho
WORKDIR /var/www/html

# Copiar os arquivos do projeto para o contêiner
COPY ./app .

# Expor a porta padrão do Apache
EXPOSE 80

# Copiar arquivo de configuração do Xdebug
COPY ./config/xdebug.ini /usr/local/etc/php/conf.d/xdebug.ini

# Configurar permissões de pasta para Apache
RUN chown -R www-data:www-data /var/www/html

# Comando para iniciar o Apache no modo foreground
CMD ["apache2-foreground"]
