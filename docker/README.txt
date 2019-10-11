Add env vars:

DOCKER_NGINX_PORT=8099
DOCKER_MYSQL_PORT=3399

You will need to change mysql host to your local ip. ie:

DB_CONNECTION=mysql
DB_HOST=10.0.0.9
DB_PORT=3399
DB_DATABASE=homestead
DB_USERNAME=homestead
DB_PASSWORD=secret


---


docker-compose up

docker exec -it d271f2775474 bash
cd /var/www/html