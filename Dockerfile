FROM php:8.3-fpm

# -----------------------------
# ARGs for macOS UID/GID
# -----------------------------
ARG UID=501
ARG GID=1000

# -----------------------------
# System dependencies
# -----------------------------
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    curl \
    libzip-dev \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    libicu-dev \
    && docker-php-ext-install \
        pdo_mysql \
        mbstring \
        zip \
        exif \
        pcntl \
        intl \
        sockets \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

# -----------------------------
# Create application user (macOS safe)
# -----------------------------
RUN groupadd -g ${GID} appgroup \
    && useradd -u ${UID} -g ${GID} -m appuser

# -----------------------------
# PHP temp directory (use system /tmp — no permission issues)
# -----------------------------
RUN echo "sys_temp_dir = /tmp" > /usr/local/etc/php/conf.d/temp.ini

# -----------------------------
# PHP-FPM: run as appuser
# -----------------------------
RUN sed -i \
    -e 's/^user = www-data/user = appuser/' \
    -e 's/^group = www-data/group = appgroup/' \
    /usr/local/etc/php-fpm.d/www.conf

# -----------------------------
# Install Composer
# -----------------------------
RUN curl -sS https://getcomposer.org/installer \
    | php -- --install-dir=/usr/local/bin --filename=composer

ENV COMPOSER_HOME=/tmp/composer-home
ENV COMPOSER_CACHE_DIR=/tmp/composer-cache

# -----------------------------
# App directory permissions
# -----------------------------
RUN mkdir -p /var/www/html/tafseela \
    && chown -R appuser:appgroup /var/www

# -----------------------------
# Switch user
# -----------------------------
USER appuser

WORKDIR /var/www/html/tafseela

EXPOSE 9000

CMD ["php-fpm"]