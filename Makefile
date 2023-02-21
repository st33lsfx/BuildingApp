init:
	make init-be
	make init-fe
init-be:
	composer install
init-fe:
	npm install
	npm run dev
	bin/console assets:install
pre-commit:
	composer phpstan
	composer ecs-dry
	composer phpunit
	composer validate-schema
pre-commit-fix:
	composer ecs-fix
database-reset:
	bin/console doctrine:database:drop --force --if-exists
	bin/console doctrine:database:create
	make migrations-migrate
migrations-diff:
	bin/console doctrine:cache:clear-metadata
	bin/console doctrine:migrations:diff --no-interaction
migrations-migrate:
	bin/console doctrine:migrations:migrate --no-interaction
load-fixtures:
	bin/console doctrine:fixtures:load --no-interaction
