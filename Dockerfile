# Use an official PHP image as a parent image
FROM php:7.4-apache

# Copy the application files into the container
COPY ./app /var/www/html

# Copy Apache configuration file
COPY apache.conf /etc/apache2/conf-available/custom.conf

# Enable Apache mod_rewrite and the new configuration
RUN a2enmod rewrite && a2enconf custom

# Install necessary PHP extensions
RUN docker-php-ext-install mysqli pdo pdo_mysql

# Set the working directory
WORKDIR /var/www/html

# Expose port 80 to the outside world
EXPOSE 80
