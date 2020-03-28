# PHP CHALLENGE - XML FILES

This is a PHP Challenge proposed as a test for a job opportunity.

## Prerequisites

```
- PHP Composer (https://getcomposer.org/download/)
- Docker (https://docs.docker.com/install/)
- Docker Compose (https://docs.docker.com/compose/install/)
```

### Getting Started

First, clone this repository from: (https://github.com/gdiasb12/phpchallenge.git)

```
For https use: git clone https://github.com/gdiasb12/phpchallenge.git

For ssh use: git clone git@github.com:gdiasb12/phpchallenge.git

```

### Running it

After cloning the repository, use the command below to start up the docker container
```
docker-compose up -d
```
Then, you gonna need a terminal instance to continue
```
docker exec -it phpchallenge-php-fpm /bin/bash
```

Now, run the following command to install the required packages 
```
composer install
```

The next command will generate a new key to the .env file:
```
php artisan key:generate
```

To generate the migrations for the database, use
```
php artisan migrate
```

**Important**: to setup laravel storage permission
```
chmod -R 777 storage/
```

The command below creates a symbolic link to access the stored files 
```
php artisan storage:link
```

### Testing it

Before we go to the browser, run the tests to make sure that everything is ok with our application 
```
php artisan test
```

## On the Browser

You can access the application at:
```
127.0.0.1:8888
```
## Built With

* [Laravel](https://laravel.com/) - The laravel framework used 

## Author

* **Gabriel Dias Barbosa**
