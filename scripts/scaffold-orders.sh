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
  "Features/Order/Domain/Model"
  "Features/Order/Domain/Enum"
  "Features/Order/Domain/Exception"
  "Features/Order/Domain/ValueObject"
  "Features/Order/Application/DTO"
  "Features/Order/Application/Port/In"
  "Features/Order/Application/Port/Out"
  "Features/Order/Application/Service"
  "Features/Order/Infrastructure/Adapter/In/Http/Requests"
  "Features/Order/Infrastructure/Adapter/In/Http/Resources"
  "Features/Order/Infrastructure/Adapter/In/Webhook"
  "Features/Order/Infrastructure/Adapter/In/Queue"
  "Features/Order/Infrastructure/Adapter/In/Console"
  "Features/Order/Infrastructure/Adapter/Out/Persistence"
  "Features/Order/Infrastructure/Adapter/Out/Payment"
  "Features/Order/Infrastructure/Adapter/Out/Messaging"
  "Features/Order/Infrastructure/Config"

  # Product
  "Features/Product/Domain/Model"
  "Features/Product/Domain/Exception"
  "Features/Product/Application/DTO"
  "Features/Product/Application/Port/In"
  "Features/Product/Application/Port/Out"
  "Features/Product/Application/Service"
  "Features/Product/Infrastructure/Adapter/In/Http/Requests"
  "Features/Product/Infrastructure/Adapter/In/Http/Resources"
  "Features/Product/Infrastructure/Adapter/Out/Persistence"
  "Features/Product/Infrastructure/Config"

  # Tenant
  "Features/Tenant/Domain/Model"
  "Features/Tenant/Application/Port/Out"
  "Features/Tenant/Application/Service"
  "Features/Tenant/Infrastructure/Adapter/In/Http"
  "Features/Tenant/Infrastructure/Adapter/Out/Persistence"
  "Features/Tenant/Infrastructure/Config"

  # Shared
  "Shared/Domain/ValueObject"
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