FROM php:8.2-apache

# Instalar dependencias del sistema
RUN apt-get update && apt-get install -y \
    git unzip curl zip libpng-dev libonig-dev libxml2-dev \
    libzip-dev libjpeg-dev libfreetype6-dev nano

# Instalar extensiones de PHP
RUN docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install pdo_mysql mbstring zip bcmath gd

# Instalar Node.js
RUN curl -fsSL https://deb.nodesource.com/setup_18.x | bash - \
    && apt-get install -y nodejs

# Habilitar mod_rewrite para Laravel
RUN a2enmod rewrite

# Crear directorio de la app
RUN mkdir -p /home/site/wwwroot

# Cambiar DocumentRoot de Apache
RUN sed -i 's|DocumentRoot /var/www/html|DocumentRoot /home/site/wwwroot/public|g' /etc/apache2/sites-available/000-default.conf

# 🔥 Agregar permisos en Apache (esto evita el 403 Forbidden)
RUN echo '<Directory /home/site/wwwroot/public>\n\
    AllowOverride All\n\
    Require all granted\n\
</Directory>' >> /etc/apache2/apache2.conf

# Establecer directorio de trabajo
WORKDIR /home/site/wwwroot

# COPY .env .env
# Copiar código Laravel
COPY . .

# Copiar composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Instalar dependencias PHP
RUN composer install --optimize-autoloader

# Compilar assets de frontend
RUN npm install && npm run build

# Dar permisos correctos
RUN chown -R www-data:www-data /home/site/wwwroot \
    && chmod -R 755 storage bootstrap/cache

EXPOSE 80

# 🔧 Comando de inicio para Apache
CMD ["apache2-foreground"]
