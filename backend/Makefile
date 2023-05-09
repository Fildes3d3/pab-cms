reset-db:
	@docker-compose up -d php-fpm-php || true
	docker exec php-fpm-php backend/bin/console doctrine:database:drop --force --if-exists
	docker exec php-fpm-php backend/bin/console doctrine:database:create
	docker exec php-fpm-php backend/bin/console doctrine:migrations:migrate --no-interaction
	docker exec php-fpm-php backend/bin/console doctrine:fixtures:load --no-interaction

reset-test-db:
	@docker-compose up -d php-fpm-php || true
	docker exec php-fpm-php backend/bin/console doctrine:database:drop --force --if-exists --env=test
	docker exec php-fpm-php backend/bin/console doctrine:database:create --env=test
	docker exec php-fpm-php backend/bin/console doctrine:migrations:migrate --no-interaction --env=test
	docker exec php-fpm-php backend/bin/console doctrine:fixtures:load --no-interaction --env=test

fix:
	@docker-compose up -d php-fpm || true
	docker exec -it php-fpm-php sh -c "backend/tools/php-cs-fixer/vendor/bin/php-cs-fixer fix --stop-on-violation --using-cache=no backend/src & backend/vendor/bin/phpstan analyse -l 1 -c backend/phpstan.neon backend/src & backend/node_modules/.bin/eslint backend/ui --fix & wait"
	yarn lint

