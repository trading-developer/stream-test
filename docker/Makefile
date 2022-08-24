init: up composer_install
up:
	docker-compose up -d
composer_install:
	docker-compose run --rm stream-app-php composer install
migrate:
	docker-compose run --rm stream-app-php php artisan migrate --force
recreate-php:
	docker-compose up -d --force-recreate --no-deps --build stream-app-php
recreate-pg:
	docker-compose up -d --force-recreate --no-deps --build stream-app-postgres
gophp:
	docker-compose exec stream-app-php bash
docker-down-clear:
	docker-compose down -v --remove-orphans