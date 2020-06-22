# Mock EPL Server

> A Laravel API which enables admin create teams and fixtures

## Description
This project was built with Laravel and MySQL.

## Requirements
To run the API, you must have:
- **PHP** (https://www.php.net/downloads)
- **MySQL** (https://dev.mysql.com/downloads/installer)

## Running the API

Create an `.env` file using the command. You can use this config or change it for your purposes. 

```console
$ cp .env.example .env
```

### Environment
Configure environment variables in `.env` for dev environment based on your MYSQL database configuration

```  
DB_CONNECTION=<YOUR_MYSQL_TYPE>
DB_HOST=<YOUR_MYSQL_HOST>
DB_PORT=<YOUR_MYSQL_PORT>
DB_DATABASE=<YOUR_DB_NAME>
DB_USERNAME=<YOUR_DB_USERNAME>
DB_PASSWORD=<YOUR_DB_PASSWORD>
```

### Installation
Install the dependencies and start the server

```console
$ composer install
$ php artisan key:generate
$ php artisan migrate --seed
$ php artisan jwt:secret
$ php artisan serve
```

### API documentation:
API End points and documentation can be found at:
[Postman Documentation](https://documenter.getpostman.com/view/5928045/SzzoabXz?version=latest).