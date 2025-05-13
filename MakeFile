init:
	docker-compose up -d --build
	docker-compose exec php composer install
	docker-compose exec php cp .env.example .env
	docker-compose exec php php artisan key:generate
	@make fresh
	docker-compose exec php bash -c "chmod -R 777 storage bootstrap/cache"
	@make npm-setup

fresh:
	docker compose exec php php artisan migrate:fresh --seed

npm-setup:
	cd src && npm install

npm-watch:
	cd src && npm run watch
