I tried to observe **SOLID** principles and **PSR-12** in this service and resolve problems using the **Factory Method** and **Strategy** design patterns.

### Run the Docker

In the root of the directory run below commands:
```sh
$ docker-compose up -d --build

$ docker-compose exec app composer install
$ docker-compose exec app php artisan migrate
$ docker-compose exec app php db:seed
```

## Run the App

- Open your browser and:
  - visit application: **http://127.0.0.1:8080**
  - visit phpMyAdmin: **http://127.0.0.1:8585**
