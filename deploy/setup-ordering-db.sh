#!/bin/bash
# Import ordering database and write db-local.php (run on VPS as site user).
set -e
cd "$(dirname "$0")/.."

if [ -f deploy/env ]; then
  set -a
  # shellcheck disable=SC1091
  source deploy/env
  set +a
fi

ORDER_DB_NAME="${ORDER_DB_NAME:-sharmakama}"
ORDER_DB_USER="${ORDER_DB_USER:-$WP_DB_USER}"
ORDER_DB_PASS="${ORDER_DB_PASS:-$WP_DB_PASS}"
ORDER_DB_HOST="${ORDER_DB_HOST:-127.0.0.1}"

if [ -z "$ORDER_DB_USER" ] || [ -z "$ORDER_DB_PASS" ]; then
  echo "Set ORDER_DB_* or WP_DB_* in deploy/env first."
  exit 1
fi

echo "Writing online/admin/db-local.php and online/theme/db-local.php ..."
php -r "
\$h = getenv('ORDER_DB_HOST') ?: '${ORDER_DB_HOST}';
\$u = getenv('ORDER_DB_USER') ?: '${ORDER_DB_USER}';
\$p = getenv('ORDER_DB_PASS') ?: '${ORDER_DB_PASS}';
\$n = getenv('ORDER_DB_NAME') ?: '${ORDER_DB_NAME}';
\$c = \"<?php\\n\\\$host = '\$h';\\n\\\$user = '\$u';\\n\\\$pass = '\$p';\\n\\\$db   = '\$n';\\n\";
file_put_contents('online/admin/db-local.php', \$c);
file_put_contents('online/theme/db-local.php', \$c);
echo \"db-local.php -> \$n\\n\";
"

echo "Creating database ${ORDER_DB_NAME} (if permitted) ..."
mysql -h "$ORDER_DB_HOST" -u "$ORDER_DB_USER" -p"$ORDER_DB_PASS" \
  -e "CREATE DATABASE IF NOT EXISTS \`${ORDER_DB_NAME}\` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;" \
  2>/dev/null || echo "(CREATE DATABASE skipped — create ${ORDER_DB_NAME} in CloudPanel if needed)"

if [ ! -f database/sharma_kama.sql ]; then
  echo "Missing database/sharma_kama.sql"
  exit 1
fi

echo "Importing database/sharma_kama.sql into ${ORDER_DB_NAME} ..."
mysql -h "$ORDER_DB_HOST" -u "$ORDER_DB_USER" -p"$ORDER_DB_PASS" "$ORDER_DB_NAME" < database/sharma_kama.sql

php deploy/diagnose-online-order.php
echo "Done. Test: https://${DOMAIN:-restaurantkamasutra.nl}/online/online-order.php"
