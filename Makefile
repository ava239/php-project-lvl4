start:
	php artisan serve --host 0.0.0.0

setup:
	composer install
	cp -n .env.example .env || true
	php artisan key:gen --ansi
	touch database/database.sqlite
	php artisan migrate
	php artisan db:seed
	npm install

docker-setup:
	composer install
	cp -n .env.docker .env || true
	php artisan key:gen --ansi
	npm install
	docker-compose build

migrate:
	php artisan migrate

console:
	php artisan tinker

log:
	tail -f storage/logs/laravel.log

test:
	php artisan test

test-coverage:
	php artisan test --coverage-clover build/logs/clover.xml

deploy:
	git push heroku

lint:
	composer exec --verbose phpcs
	composer exec --verbose phpstan analyse

lint-fix:
	composer exec --verbose phpcbf

compose:
	heroku local -f Procfile.dev

compose-up:
	docker-compose up

compose-bash:
	docker-compose run app bash

compose-setup: compose-build
	docker-compose run app make setup

compose-build:
	docker-compose build

compose-migrate:
	docker-compose run app make migrate

compose-db:
	docker-compose exec db psql -U postgres

compose-down:
	docker-compose down -v
