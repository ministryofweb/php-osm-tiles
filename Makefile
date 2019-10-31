PHPSTAN_LEVEL=max

.PHONY: ci
.PHONY: coding-standards
.PHONY: composer-validate
.PHONY: lint
.PHONY: static-analysis
.PHONY: phpstan
.PHONY: psalm
.PHONY: test
.PHONY: php-cs-fixer

ci: composer-validate lint static-analysis sniff coding-standards test

lint:
	./vendor/bin/parallel-lint src

static-analysis: phpstan psalm

phpstan:
	./vendor/bin/phpstan analyse --level=$(PHPSTAN_LEVEL) src

psalm:
	./vendor/bin/psalm

sniff:
	./vendor/bin/phpcs --standard=phpcs.xml.dist src

coding-standards: sniff
	./vendor/bin/phpmd src text cleancode,codesize,controversial,design,naming,unusedcode

composer-validate:
	composer validate --no-check-publish

test:
	./vendor/bin/phpunit

php-cs-fixer:
	./vendor/bin/php-cs-fixer fix
