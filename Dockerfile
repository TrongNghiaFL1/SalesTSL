FROM php:7.4-fpm
# Cài đặt netcat và các thư viện cần thiết cho PHP
RUN apt-get update && apt-get install -y netcat libpng-dev libjpeg-dev libfreetype6-dev zip unzip \
  && docker-php-ext-configure gd --with-freetype --with-jpeg \
  && docker-php-ext-install gd mysqli pdo pdo_mysql
WORKDIR /var/www/html
COPY Source/ /var/www/html/
RUN chown -R www-data:www-data /var/www/html \
  && chmod -R 755 /var/www/html
EXPOSE 9000
CMD ["php-fpm"]
