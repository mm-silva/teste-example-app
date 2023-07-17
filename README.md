
# Teste

Para iniciar o servidor basta usar o docker-compose up -d na raiz do projeto.

Verifique qual é o id do php-fpm no docker:

docker ps -a

entre no php-fpm:

docker exec -it {id do container} bash

dentro do container execute os seguintes comandos:


cp .env.example .env

composer install

php artisan migrate


Verifique a porta que o container está rodando:


docker ps -a


Depois é só entrar no endereço localhost:8000 ou na porta definida para esse container




