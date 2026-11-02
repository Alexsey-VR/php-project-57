FROM php:8.5-cli

RUN apt-get update && apt-get install -y \
    libpq-dev \
    libzip-dev
RUN docker-php-ext-install pdo pdo_pgsql zip

RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" \
    && php composer-setup.php --install-dir=/usr/local/bin --filename=composer \
    && php -r "unlink('composer-setup.php');"

RUN curl -sL https://deb.nodesource.com/setup_24.x | bash -
RUN apt-get install -y nodejs

WORKDIR /app

COPY package.json ./
COPY package-lock.json ./

RUN npm cache clean --force
RUN npm install -g npm@latest
RUN npm install --workspaces=false

COPY . .

RUN cp .env.example .env \
    && echo "APP_KEY=base64:$(php -r 'echo base64_encode(random_bytes(32));')" >> .env
RUN composer install --no-interaction --no-progress
RUN npm install --ignore-scripts
RUN npm run build

RUN > database/database.sqlite

EXPOSE 8080
EXPOSE 5432

RUN php artisan config:clear
RUN php artisan view:clear
RUN php artisan route:clear

CMD ["bash", "-c", "php artisan migrate:fresh --force && php artisan db:seed --force && PHP_CLI_SERVER_WORKERS=5 php artisan serve --host=0.0.0.0 --port=$PORT"]