# Eastren Enterprise Coding aaignment 

## Description
```
This web application is designed to allow users to manage company details effortlessly.
Users can create an account, log in, and add company information, including logo, name, description, and address.
Additionally, non-authenticated users can access a page displaying company details, along with financial information and real-time stock values on NASDAQ obtained from the open API source for the demo I hve used "Finnhub".

```

## Technologies Used
Laravel 10
LiveWire
Tailwind CSS

## Architecture
The application follows the (onion) architecture with screaming architecture principles,and combined with ddd ensuring a clean and modular codebase.

## Installation Instructions "using Docker Compose"

```
- kindely make sure that you have docker && docker compose installed on your machine, then run the following commands in the terminal:

- 'docker-compose up -d'
- 'docker-compose exec composer composer install'
- 'docker-compose exec php php artisan optimize'
- 'docker-compose exec php php artisan key:generate'
- 'docker-compose exec php php artisan migrate --seed'
- 'docker-compose exec php php artisan storage:link'
- 'docker-compose exec npm npm run build'

- now you can enjoy the app on http://127.0.0.1:8000/

test can be done by : 
- 'docker-compose exec php php artisan test'

-NOTES  :

The Generated Admin Cridentioals is :
    - email : "admin@admin.com"
    - password : "123456789"
```
