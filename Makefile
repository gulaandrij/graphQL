help:
	@echo "usage: make COMMAND [c=[arguments]]"
	@echo ""
	@echo "Commands:"
	@echo "  up                            Up all docker services"
	@echo "  down                          Stop all docker services"
	@echo "  dps                           Show all running containers"
	@echo "  composer-update               Update composer packages in symfony app"
	@echo "  composer-install              Install composer packages in symfony app"
	@echo "  console                       Run Symfony console"
	@echo "  precommit                     Code beautifier + Code sniffer"
	@echo "  unit                          Run phpunit tests"
	@echo "  db-refresh                    Refresh DB and load fixtures"
	@echo "  chmod                         Set chmod 0777 for symfony folders"
	@echo "  ansible-nginx-symfony-update  Update nginx configuration from \"build/ansible/nginx-files"\"

# Symfony console
console:
	@docker exec -i graphql.app bin/console --ansi $(c)
	@make chmod

# Show all running containers
dps:
	@docker ps --format "table {{.ID}}\t{{.Ports}}\t{{.Names}}"

# Up docker environment
up:
	@docker-compose up -d --build --force-recreate
	@make dps

# Down docker environment
down:
	@docker stop $(shell docker ps -a -q)

# Update composer packages
composer-update:
	@docker exec -it graphql.app composer update
	@docker exec -it graphql.app bin/console doctrine:cache:clear-metadata
	@make chmod

# Update composer packages
composer-install:
	@docker exec -it graphql.app composer install
	@docker exec -it graphql.app bin/console doctrine:cache:clear-metadata
	@make chmod

# Dump autoload
composer-du:
	@docker exec -it graphql.app composer du

# Pre-commit hooks (code sniffer + code beautifier)
precommit:
	@docker exec -i graphql.app /bin/bash -c "vendor/bin/phpcbf . && vendor/bin/phpcs . && bin/console doctrine:schema:validate --env=dev"

# Pre-commit hooks (code sniffer + code beautifier)
cbf:
	@vendor/bin/phpcbf . && \
	vendor/bin/phpcs . && \
	docker exec -i graphql.app /bin/bash -c "bin/console doctrine:schema:validate"

# Run codecepts tasks
codecept:
	@cd ./build/AcceptanceTests/ && node_modules/.bin/codeceptjs run --steps && cd ./../..

# Run unit tests in symfony-app
unit: before-unit
	@docker exec -i graphql.app bin/phpunit --colors=always

paraunit: before-unit
	@docker exec -i graphql.app vendor/bin/paratest -p8 --phpunit bin/phpunit tests

# Pre execution before start phpunit
before-unit:
	@docker exec -i graphql.app bash -c "\
	bin/console --env=test doctrine:database:drop --force --if-exists > /dev/null && \
	bin/console --env=test doctrine:database:create > /dev/null && \
	bin/console --env=test doctrine:cache:clear-metadata > /dev/null && \
	rm -rf var/cache/* > /dev/null && \
	bin/console --env=test cache:warmup -q > /dev/null && \
	bin/console --env=test doctrine:migrations:migrate --no-interaction -q > /dev/null && \
	bin/console --env=test doctrine:fixtures:load -n > /dev/null"

# Rebuild whole db and make seed data
db-refresh:
	@docker exec -i graphql.app bash -c "\
	bin/console doctrine:database:drop --force --if-exists --env=dev && \
	bin/console doctrine:database:create  --env=dev && \
	bin/console doctrine:migrations:migrate --no-interaction -q --env=dev && \
	bin/console doctrine:fixtures:load -n --env=dev && \
	composer du && \
	bin/console doctrine:schema:validate --env=dev && \
	bin/console fos:elastica:populate && \
	chmod -R 0777 ."

db-backup:
	@docker exec -it graphql.app bin/console backup-manager:backup development local -c gzip

chmod:
	@docker exec -it graphql.app chmod -R 0777 .

router:
	@docker exec -it graphql.app bin/console debug:router

elastic-populate:
	@docker exec -it graphql.app bin/console fos:elastica:populate

migrate-diff: cache-clear
	@docker exec -it graphql.app bin/console doct:migr:diff --formatted
	@make chmod

migrate-up:
	@docker exec -it graphql.app bin/console --env=dev doct:migr:migrate --no-interaction

migrate-down:
	@docker exec -it graphql.app bin/console --env=dev doct:migr:migrate prev --no-interaction

blackfire:
	@docker exec -it graphql.app blackfire curl $(c)

cache-clear: composer-du
	@docker exec -i graphql.app bash -c "\
	bin/console doctrine:cache:clear-metadata && \
	rm -rf var/cache/* && \
	bin/console cache:warmup && \
	chmod -R 0777 ."

bash:
	@docker exec -it graphql.app bash

route:
	@docker exec -it graphql.app bin/console debug:router $(c)
