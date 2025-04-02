#!/usr/bin/make
# Makefile readme (ru): <http://linux.yaroslavl.ru/docs/prog/gnu_make_3-79_russian_manual.html>
# Makefile readme (en): <https://www.gnu.org/software/make/manual/html_node/index.html#SEC_Contents>

SHELL = /bin/sh
.PHONY : help
.DEFAULT_GOAL : help


help: ## Show this help
	@awk 'BEGIN {FS = ":.*?## "} /^[a-zA-Z_-]+:.*?## / {printf "  \033[36m%-15s\033[0m %s\n", $$1, $$2}' $(MAKEFILE_LIST)

install: composer npm artisan-install  ## Install Application


run: ## Run service
	php artisan serve & \
	npm run dev
# Установка JavaScript-зависимостей через npm
npm:
	@echo "Устанавливаем JavaScript-зависимости через npm..."
	npm install


# Установка PHP-зависимостей через Composer
composer:
	@echo "Устанавливаем PHP-зависимости через Composer..."
	composer install
# Запуск основных artisan-команд
artisan-install:
	@echo "Настраиваем приложение Laravel..."
	php artisan key:generate
	php artisan migrate
