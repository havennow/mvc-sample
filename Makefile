ifeq ($(OS),Windows_NT)
	EXECUTABLE=winpty
else
	EXECUTABLE=
endif

build: ## Build php-fpm
	docker-compose build

install: ## Run composer, install vendor
	make build && make clear && $(EXECUTABLE) docker-compose exec php-fpm bash -c "composer install"

start: ## Up containers
	docker-compose up -d

stop: ## Stop containers
	docker-compose stop

shell: ## Access bash in, php-fpm container
	make clear && $(EXECUTABLE) docker-compose exec php-fpm bash

clear: ## Start and clear
	clear && make start

help: ## This help.
	@awk 'BEGIN {FS = ":.*?## "} /^[a-zA-Z_-]+:.*?## / {printf "\033[36m%-30s\033[0m %s\n", $$1, $$2}' $(MAKEFILE_LIST)

.DEFAULT_GOAL := help
