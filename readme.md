# How to setup the project

If you are using Linux, please run the next commands, this commands will guide you with the setup

```shell
$ id -u // output 1000
$ id -g // output 1000
$ docker network create -d bridge nyrentek
$ cp .env.example .env
```
if  the output of the first and second command is different from 1000 please add the next files the .env file,  
please be caution on the replace

```text
USER_ID=//Output of the command id -u
GROUP_ID=//output of the command id -g
```

Ant then run: 

```shell
$ docker-compose up -d
```

## How to install dependencies

You can enter to the container running:

```shell
$ docker exec -u www-data -it nyrentek_backend bash
container@container$ composer install
container@container$ php artisan key:generate
container@container$ php artisan migrate
container@container$ npm i
container@container$ npm run dev
```

Otras maneras:

```shell
$ docker-compose exec backend bash -c "composer install"
$ docker-compose exec backend bash -c "php artisan key:generate"
$ docker-compose exec backend bash -c "php artisan migrate"
$ docker-compose exec backend bash -c "npm i"
$ docker-compose exec backend bash -c "npm run dev"
```

## Acceso

```text
User: test@example.com
Password: password
```
