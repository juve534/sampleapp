container=phpfpm

init:
	cp .env.example .env
	docker-compose up -d
	docker-compose exec $(container) composer install
	docker-compose exec $(container) php artisan key:generate
	docker-compose exec $(container) php artisan migrate

up:
	docker-compose up -d

down:
	docker-compose down

build:
	docker build -t juve534/php-fpm:7.3 .

ps:
	docker-compose ps

test:
	docker-compose exec $(container) vendor/bin/phpunit tests

composer:
	docker-compose exec $(container) composer $(CMD)

cs-check:
	docker-compose exec $(container) composer cs-check

cs-fix:
	docker-compose exec $(container) composer cs-fix

.PHONY: artisan
artisan:
	docker-compose exec $(container) php artisan $(CMD)