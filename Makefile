docker-up:
	docker-compose up -d
	docker-compose exec php-cli ln -sfn /var/www/storage/app/public public/storage

docker-down:
	docker-compose down

docker-build:
	docker-compose up --build -d
	docker-compose exec php-cli ln -sfn /var/www/storage/app/public public/storage

test:
	docker-compose exec php-cli vendor/bin/phpunit

perm:
	sudo chgrp -R www-data storage bootstrap/cache
	sudo chmod -R ug+rwx storage bootstrap/cache
