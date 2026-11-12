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
RUN npm install -g npm@11.9.0
RUN npm ci --ignore-scripts --workspaces=false

COPY . .

RUN cp .env.deploy .env \
    && echo "APP_KEY=base64:$(php -r 'echo base64_encode(random_bytes(32));')" >> .env
RUN composer install --no-interaction --no-progress --no-dev
RUN npm run build

RUN > database/database.sqlite

EXPOSE 8080

CMD ["bash", "-c", "php artisan migrate:fresh --force && php artisan db:seed --class DatabaseSeeder --force && php artisan db:seed --class TaskSeeder --force && php artisan optimize:clear && PHP_CLI_SERVER_WORKERS=5 php artisan serve --host=0.0.0.0 --port=$PORT --no-reload"]
