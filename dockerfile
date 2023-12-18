# Use the official PHP image as the base image
FROM php:7.4-apache

# Set the working directory in the container
WORKDIR /var/www/html

# Copy your CodeIgniter 4 files to the container
COPY . /var/www/html

# Enable Apache modules (if needed)
RUN a2enmod rewrite

# Expose the port where your application runs
EXPOSE 80
