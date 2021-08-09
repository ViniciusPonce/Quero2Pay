# Quero 2 Pay
PHP Programmer Test
=======
<p align="center"><img src="https://www.quero2pay.com.br/wp-content/uploads/2021/03/Quero2Pay_logo.svg"></p>


## Descrições

Projeto desenvolvido em [Laravel 7](https://laravel.com/docs/8.x)

## Requisitos

* [Composer](https://getcomposer.org/)
* [PHP >= 7.4](https://www.php.net/)
* [Nodejs 10.18](https://nodejs.org/en/)
* [Docker](https://www.docker.com/) (Obrigatório)


## Instalação do Projeto Local
##### 1 - Após download, dentro da pasta do projeto renomeie o arquivo ```.env.example``` para ```.env```.  e dentro dele preencha as variáveis:

* DB_CONNECTION=mysql
* DB_HOST=mysql
* DB_PORT=3306
* DB_DATABASE=quero2
* DB_USERNAME=user
* DB_PASSWORD=root

##### 2 - Execute os comandos abaixo:
* ```composer install```
* ```npm install```
* ```npm run dev```
* ```docker-compose up -d```
* ```docker-compose exec php-fpm bash php artisan key:generate```
* ```docker-compose exec php-fpm bash php artisan migrate```

##### 3 - Se houver a necessidade, alterar as a variavel ```ports:``` dentro do arquivo docker-compose.yml referente ao container utilizado:

* ##### webserver:
#### ou
* #### mysql: (caso for alterado a porta da imagem mysql, alterar tambem as variveis do arquivo ```.env```, citadas acima)

* Caso seja testa em SO Linux, poderá pedir permissão na pasta
#### ```sudo chmod 777 -R storage/```
