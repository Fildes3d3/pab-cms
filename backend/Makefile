fix:
	@docker-compose up -d php-fpm || true
	docker exec -it php-fpm-php sh -c "backend/tools/php-cs-fixer/vendor/bin/php-cs-fixer fix --stop-on-violation --using-cache=no backend/src & backend/vendor/bin/phpstan analyse -l 1 -c backend/phpstan.neon backend/src & backend/node_modules/.bin/eslint backend/ui --fix & wait"
	yarn lint

