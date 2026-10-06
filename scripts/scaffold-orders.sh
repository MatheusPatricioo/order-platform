#!/usr/bin/env bash
# Cria a estrutura hexagonal + feature package do serviço orders.
# Rodar na raiz do order-platform, DEPOIS de instalar o Laravel em services/orders.

set -e

BASE="services/orders/app"

if [ ! -d "$BASE" ]; then
  echo "Laravel não encontrado em services/orders. Instale antes de rodar este script."
  exit 1
fi

dirs=(
  # Order
  "Features/Order/Domain/Entities"
  "Features/Order/Domain/Enums"
  "Features/Order/Domain/Exceptions"
  "Features/Order/Application/DTOs"
  "Features/Order/Application/Interfaces"
  "Features/Order/Application/Services"
  "Features/Order/Infrastructure/Http/Controllers"
  "Features/Order/Infrastructure/Http/Requests"
  "Features/Order/Infrastructure/Http/Resources"
  "Features/Order/Infrastructure/Webhooks"
  "Features/Order/Infrastructure/Jobs"
  "Features/Order/Infrastructure/Console"
  "Features/Order/Infrastructure/Persistence"
  "Features/Order/Infrastructure/Payment"
  "Features/Order/Infrastructure/Messaging"
  "Features/Order/Infrastructure/Providers"

  # Product
  "Features/Product/Domain/Entities"
  "Features/Product/Domain/Exceptions"
  "Features/Product/Application/DTOs"
  "Features/Product/Application/Interfaces"
  "Features/Product/Application/Services"
  "Features/Product/Infrastructure/Http/Controllers"
  "Features/Product/Infrastructure/Http/Requests"
  "Features/Product/Infrastructure/Http/Resources"
  "Features/Product/Infrastructure/Persistence"
  "Features/Product/Infrastructure/Providers"

  # Tenant
  "Features/Tenant/Domain/Entities"
  "Features/Tenant/Application/Interfaces"
  "Features/Tenant/Application/Services"
  "Features/Tenant/Infrastructure/Http/Middleware"
  "Features/Tenant/Infrastructure/Persistence"
  "Features/Tenant/Infrastructure/Providers"

  # Shared
  "Shared/Domain/ValueObjects"
  "Shared/Infrastructure/Http/Middleware"
  "Shared/Infrastructure/Observability"
)

for d in "${dirs[@]}"; do
  mkdir -p "$BASE/$d"
  touch "$BASE/$d/.gitkeep"
done

# Pastas de teste
for d in "Unit/Order" "Unit/Product" "Feature/Order" "Feature/Product" "Feature/Tenant"; do
  mkdir -p "services/orders/tests/$d"
  touch "services/orders/tests/$d/.gitkeep"
done

echo "Estrutura do orders criada com sucesso."