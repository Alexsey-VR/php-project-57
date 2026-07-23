install:
	composer install --no-ansi --no-interaction --no-progress

update:
	composer update

validate:
	composer validate

PORT ?= 8000
start: init
	PHP_CLI_SERVER_WORKERS=5 php artisan serve

test: init
	XDEBUG_MODE=coverage vendor/bin/paratest tests --coverage-text --processes=auto

test-dev:
	XDEBUG_MODE=coverage vendor/bin/paratest tests --coverage-html ./reports --processes=auto

test-sonar: init
	XDEBUG_MODE=coverage vendor/bin/paratest --coverage-clover=coverage.xml tests

init:
	php artisan migrate

lint:
	composer exec --verbose phpcs -- --standard=PSR12 public/ routes/ app/ tests/

analyze:
	composer exec -v phpstan analyze -- -c vendor/phpstan/phpstan/conf/phpstan.neon --level 8 --ansi public/ app/ tests/

dev-init:
	./vendor/bin/phpunit --generate-configuration

