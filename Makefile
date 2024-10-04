init: docker-down-clear api-clear \
	docker-pull docker-build docker-up api-init

up: docker-up
down: docker-down
restart: down up

rebuild: docker-down api-clear \
	docker-pull docker-build docker-up api-init

update-deps: api-composer-update restart

docker-up:
	docker compose up -d

docker-down:
	docker compose down --remove-orphans

docker-down-clear:
	docker compose down -v --remove-orphans

docker-pull:
	docker compose pull

docker-build:
	docker compose build --pull


api-clear:
	docker run --rm -v ${PWD}:/app -w /app alpine sh -c 'rm -rf storage/framework/cache/data/* storage/framework/sessions/* storage/framework/testing/* storage/framework/views/* storage/logs/*'

api-init: api-permissions api-composer-install \
	api-copy-env api-gen-key api-wait-db api-migrations

api-permissions:
	docker run --rm -v ${PWD}:/app -w /app alpine chmod 777 -R storage bootstrap/cache

api-composer-install:
	docker compose run --rm api-php-cli composer install

api-composer-update:
	docker compose run --rm api-php-cli composer update

api-wait-db:
	docker compose run --rm api-php-cli wait-for-it api-db:5432 -t 30

api-migrations:
	docker compose run --rm api-php-cli php artisan migrate --force

api-copy-env:
	docker compose run --rm api-php-cli php -r "file_exists('.env') || copy('.env.example', '.env');"

api-gen-key:
	docker compose run --rm api-php-cli php artisan key:generate

api-backup:
	docker compose run --rm api-postgres-backup
