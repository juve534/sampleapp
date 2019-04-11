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

ps:
	docker-compose ps

test:
	docker-compose exec $(container) vendor/bin/phpunit tests

composer:
	docker-compose exec $(container) composer

.PHONY: artisan
artisan:
	docker-compose exec $(container) php artisan $(COMMAND)