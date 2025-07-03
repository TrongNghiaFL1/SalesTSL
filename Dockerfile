# Sử dụng PHP 7.4-fpm làm base image
FROM php:7.4-fpm

# Cài đặt netcat và các thư viện cần thiết cho PHP
RUN apt-get update && apt-get install -y \
    netcat \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    zip \
    unzip \
  && docker-php-ext-configure gd --with-freetype --with-jpeg \
  && docker-php-ext-install gd mysqli pdo pdo_mysql

# Đặt thư mục làm việc trong container
WORKDIR /var/www/html

# Copy mã nguồn vào container
COPY Source/ /var/www/html/

# Cấp quyền truy cập cho các file
RUN chown -R www-data:www-data /var/www/html \
  && chmod -R 755 /var/www/html

# Mở port 9000 để PHP-FPM chạy
EXPOSE 9000

# Lệnh khởi chạy container
CMD ["php-fpm"]
