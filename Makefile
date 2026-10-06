.PHONY: setup up down build restart shell migrate test logs lint format analyse hooks

setup: ## Primeira execução: sobe tudo, ajusta permissões, roda migrations e ativa os hooks
	git config core.hooksPath .githooks
	docker compose up -d --build
	docker compose exec orders chmod -R 777 storage bootstrap/cache
	docker compose exec orders php artisan migrate

up: ## Sobe os containers
	docker compose up -d

down: ## Para e remove os containers
	docker compose down

build: ## Reconstrói as imagens e sobe
	docker compose up -d --build

restart: down up ## Reinicia tudo

shell: ## Abre o terminal dentro do container do orders
	docker compose exec orders bash

migrate: ## Roda as migrations
	docker compose exec orders php artisan migrate

test: ## Roda os testes
	docker compose exec orders php artisan test

logs: ## Mostra os logs em tempo real
	docker compose logs -f

lint: ## Verifica o estilo do código sem alterar nada
	docker compose exec orders ./vendor/bin/pint --test

format: ## Corrige o estilo do código automaticamente
	docker compose exec orders ./vendor/bin/pint

analyse: ## Análise estática com PHPStan
	docker compose exec orders ./vendor/bin/phpstan analyse --memory-limit=1G

hooks: ## Ativa os Git hooks do projeto
	git config core.hooksPath .githooks