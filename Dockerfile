FROM php:8.3-fpm

# Install dependencies
RUN apt-get update && apt-get install -y \
  git \
  curl \
  libpng-dev \
  libonig-dev \
  libxml2-dev \
  zip \
  unzip \
  libfreetype6-dev \
  libjpeg62-turbo-dev \
  libzip-dev \
  && docker-php-ext-configure gd --with-freetype --with-jpeg \
  && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd zip

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- \
  --install-dir=/usr/local/bin --filename=composer

# Copy Laravel
WORKDIR /var/www/html
COPY . .

# Install dependencies
RUN composer install --optimize-autoloader --no-dev

# Set permissions
RUN chown -R www-data:www-data /var/www/html/storage
RUN chown -R www-data:www-data /var/www/html/bootstrap/cache
