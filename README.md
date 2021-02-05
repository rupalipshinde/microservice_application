Technology

1) PHP framework - Laravel
2) Test framework - phpunit
3) Database - MySQL
4) Docker - Docker Toolbox 

Instructions -

1) Install Docker ToolBox

2) create laravel project
    composer create-project laravel/laravel projectName

3) add laravel-ide-helper
    This package makes use of Laravels package auto-discovery mechanism, which means if you don't install dev dependencies in production, it also won't be loaded.

    composer require --dev barryvdh/laravel-ide-helper

    php artisan ide-helper:generate

4) Create DockerFile

    FROM php:7.4-fpm-alpine

    RUN docker-php-ext-install pdo pdo_mysql sockets
    RUN curl -sS https://getcomposer.org/installer| php -- \--install-dir=/usr/local/bin --filename     =composer

    WORKDIR /app
    COPY . .
    RUN composer install

    CMD php artisan serve --host=0.0.0.0
    EXPOSE 8000

    

5) Create a docker-compose.yml in the project directory.

    version: '3.5'
    services: 
      admin:
        build: 
          context: .
          dockerfile: Dockerfile
        ports: 
          - 8000:8000
        depends_on: 
          - admin_db

      admin_db:
        image: mysql:5.7.22
        tty: true
        environment: 
          MYSQL_DATABASE: admin
          MYSQL_USER: root
          MYSQL_PASSWORD: root
          MYSQL_ROOT_PASSWORD: root
        volumes: 
          - /dbdata:/var/lib/mysql
        ports: 
          - 33060:3306


6) Add changes to .env file

    DB_HOST=admin_db
    DB_PORT=3306
    DB_DATABASE=admin
    DB_USERNAME=root
    DB_PASSWORD=root

7) Run 
    Docker-composer up

   this will build docker file

8) Connect to MySQL - For that download TablePlus

    https://tableplus.com/

9) Create Database
     a) got inside the docker container
            docker-compose exec admin sh 
     b) php artisan migrate
     c) Create Seeder or we can use databaseSeeder
            php artisan make:seeder UserSeeder
     d) run
            php artisan db:seed