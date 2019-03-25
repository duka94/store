# Laamar

## Requirements

   -    PHP >= 7.1.3
   -    OpenSSL PHP Extension
   -    PDO PHP Extension
   -    Mbstring PHP Extension
   -    Tokenizer PHP Extension
   -    XML PHP Extension
   -    Ctype PHP Extension
   -    JSON PHP Extension
   -    BCMath PHP Extension

## Installation

- Clone the repository
 ```git clone git@github.com:duka94/store.git```
- Install dependencies (from console)
    - run ```composer install```
- Set file permissions:
    - ```chmod -R 777 storage```
- Create database: ```mysqladmin -u root -p password YOUR PASSWORD create YOUR DATABASE NAME```
- Create `.env` file from `.env.example`. Set there your mysql user, password and other needed information.
- Run migrations: ```php artisan migrate```
- Run copy image command: ```php artisan copy:images```
- Run 

     ```php artisan key:generate```

     ```php artisan storage:link```
         
-Generate admin panel assets:
 
   ```php artisan vendor:publish --provider="JeroenNoten\LaravelAdminLte\ServiceProvider" --tag=assets```
