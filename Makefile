PHPSTAN_LEVEL=max

.PHONY: ci
ci: composer-validate lint static-analysis sniff test

.PHONY: lint
lint:
	composer ci:lint

.PHONY: static-analysis
static-analysis: phpstan psalm

.PHONY: phpstan
phpstan:
	./vendor/bin/phpstan analyse --level=$(PHPSTAN_LEVEL) src

.PHONY: psalm
psalm:
	composer ci:psalm

sniff:
	composer ci:phpcs

.PHONY: composer-validate
composer-validate:
	composer validate

.PHONY: test
test:
	composer ci:tests

.PHONY: php-cs-fixer
php-cs-fixer:
	./vendor/bin/php-cs-fixer fix
