start:
	bin/console server:start 0.0.0.0:8000
	mailcatcher --ip 0.0.0.0

stop:
	bin/console server:stop

run:
	bin/console server:run 0.0.0.0:8000

autoload-refresh:
	php composer.phar dump-autoload

create-bundle:
	bin/console generate:bundle

comp-install:
	php composer.phpar install


fixtures:
	bin/console doctrine:database:drop --force --if-exists
	bin/console doctrine:database:create
	bin/console doctrine:schema:update --force
	bin/console review:fixtures

