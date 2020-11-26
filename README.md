# Laravel Test Back End From Seed Career

## How to run this app

-   setting .env, you can copy from .env-example
-   setting database

```sh
# optional, this setup database from docker
docker-compose up -d
```

-   run following commands

```sh
# install & update depedencies
composer install && composer update

# dump
composer dump-autoload

# migrate
php artisan migrate

# seeding
php artiasan db:seed

# run laravel
php artisan serve
```
