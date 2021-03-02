## Features
- Resolve problems using the **Factory Method** and **Strategy** design patterns.
- I tried to observe **SOLID** principles and PSR-12 in this code.

### Run the docker
In the root of the directory run below command:
```sh
$ docker-compose up -d --build

$ docker-compose exec app composer update
$ docker-compose exec app php artisan migrate
$ docker-compose exec app php db:seed
```

## Run the App

- Open your browser and :
  visit application : **http://127.0.0.1:8080**
  visit phpMyAdmin  : **http://127.0.0.1:8585**

**Best regards,**
Mojtaba Gheytasi
