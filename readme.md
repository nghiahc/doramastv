## Movie System

Watch movie online

### Steps to Run

1. copy .env.example to .env

2. Make sure to specify url for website APP_URL=http://eadrama.com
edit .env (Edit below if you run local mysql server.). 

3. Command needs to run on running the project
-   ### Composer
    #####Install Dependencies
    
        composer install

    #####Artisan Commands
    #####Key generate
        php artisan key:generate
    #####Migration
        php artisan migrate

    #####Seeder
        php artisan db:seed

-   ### NPM
    #####Install Node Dependencies
        npm install

    #####Compile Node Dependencies
        npm run dev

4. Launch app using docker
        
        docker-compose up -d
# doramastv
