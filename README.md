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


5) Create a docker-compose.yml in the project directory.


6) Add changes to .env file

    DB_HOST=admin_db <br/>
    DB_PORT=3306 <br/>
    DB_DATABASE=admin <br/>
    DB_USERNAME=root <br/>
    DB_PASSWORD=root <br/>

7) Run 
    Docker-composer up

   this will build docker file

8) Connect to MySQL - For that download TablePlus

    https://tableplus.com/

9) Create Database


     1) get inside the docker container
            docker-compose exec admin sh 
            
     2) php artisan migrate
     
     3) Create Seeder or we can use databaseSeeder
            php artisan make:seeder UserSeeder
     d) run
            php artisan db:seed
