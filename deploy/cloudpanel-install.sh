#!/bin/bash
# Cafe Kamasutra — CloudPanel / VPS install (run as site SSH user after "Add Site")
set -euo pipefail

SCRIPT_DIR="$(cd "$(dirname "${BASH_SOURCE[0]}")" && pwd)"
PROJECT_ROOT="$(dirname "$SCRIPT_DIR")"

if [[ -f "$SCRIPT_DIR/env" ]]; then
	# shellcheck disable=SC1091
	source "$SCRIPT_DIR/env"
	export DOMAIN WP_DB_NAME WP_DB_USER WP_DB_PASS WP_DB_HOST
	export ORDER_DB_NAME ORDER_DB_USER ORDER_DB_PASS ORDER_DB_HOST
	export REPO_URL BRANCH SITE_ROOT
fi

DOMAIN="${DOMAIN:-restaurantkamasutra.nl}"
SITE_ROOT="${SITE_ROOT:-$HOME/htdocs/$DOMAIN}"
REPO_URL="${REPO_URL:-https://github.com/rajeshkamalwar/cafe-kamasutra.git}"
BRANCH="${BRANCH:-main}"
WP_DB_NAME="${WP_DB_NAME:-restaurant}"
ORDER_DB_NAME="${ORDER_DB_NAME:-sharmakama}"

echo "==> Site root: $SITE_ROOT"
mkdir -p "$SITE_ROOT"
cd "$SITE_ROOT"

if [[ ! -d .git ]]; then
	echo "==> Cloning repository..."
	git clone --branch "$BRANCH" "$REPO_URL" .
else
	echo "==> Pulling latest..."
	git pull origin "$BRANCH"
fi

echo "==> Creating wp-config.php..."
if [[ ! -f wp-config.php ]] || grep -q '{{WP_DB_NAME}}' wp-config.php 2>/dev/null; then
	bash "$SCRIPT_DIR/make-wp-config.sh"
fi

echo "==> Online app config..."
export DOMAIN
php -r "
\$d = getenv('DOMAIN') ?: 'restaurantkamasutra.nl';
\$b = 'https://' . \$d;
file_put_contents('online/admin/config-local.php', \"<?php\n\" .
	\"define('base_url', '\$b/online/admin/');\n\" .
	\"define('online_base_url', '\$b/online/');\n\" .
	\"define('site_base_url', '\$b/');\n\");
file_put_contents('online/theme/config-local.php', \"<?php\ndefine('base_url', '\$b/online/theme/');\n\");
"
php -r "
\$h = getenv('ORDER_DB_HOST') ?: '127.0.0.1';
\$u = getenv('ORDER_DB_USER') ?: 'restaurant_user';
\$p = getenv('ORDER_DB_PASS') ?: '';
\$n = getenv('ORDER_DB_NAME') ?: 'sharmakama';
\$c = \"<?php\n\\\$host='\$h';\n\\\$user='\$u';\n\\\$pass='\$p';\n\\\$db='\$n';\n\";
file_put_contents('online/admin/db-local.php', \$c);
file_put_contents('online/theme/db-local.php', \$c);
"

echo "==> Importing databases (requires mysql client + credentials)..."
mysql -h "${WP_DB_HOST:-127.0.0.1}" -u "$WP_DB_USER" -p"$WP_DB_PASS" -e "CREATE DATABASE IF NOT EXISTS \`$WP_DB_NAME\` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;"
mysql -h "${ORDER_DB_HOST:-127.0.0.1}" -u "$ORDER_DB_USER" -p"$ORDER_DB_PASS" -e "CREATE DATABASE IF NOT EXISTS \`$ORDER_DB_NAME\` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;"
mysql -h "${WP_DB_HOST:-127.0.0.1}" -u "$WP_DB_USER" -p"$WP_DB_PASS" "$WP_DB_NAME" < database/restaurant.sql
mysql -h "${ORDER_DB_HOST:-127.0.0.1}" -u "$ORDER_DB_USER" -p"$ORDER_DB_PASS" "$ORDER_DB_NAME" < database/sharma_kama.sql

echo "==> Updating WordPress URLs..."
PROD_URL="https://${DOMAIN}"
mysql -h "${WP_DB_HOST:-127.0.0.1}" -u "$WP_DB_USER" -p"$WP_DB_PASS" "$WP_DB_NAME" -e \
	"UPDATE wpcm_options SET option_value='$PROD_URL' WHERE option_name IN ('siteurl','home');"

if command -v wp >/dev/null 2>&1; then
	wp search-replace 'http://localhost/cafekamasutra' "$PROD_URL" --all-tables --precise --skip-columns=guid 2>/dev/null || true
	wp search-replace 'https://localhost/cafekamasutra' "$PROD_URL" --all-tables --precise --skip-columns=guid 2>/dev/null || true
	wp search-replace 'http://localhost/cafekamasutra/' "${PROD_URL}/" --all-tables --precise 2>/dev/null || true
	wp cache flush 2>/dev/null || true
fi

echo "==> Permissions..."
find . -type d -exec chmod 755 {} \;
find . -type f -exec chmod 644 {} \;
chmod 600 wp-config.php online/admin/db-local.php online/theme/db-local.php 2>/dev/null || true

echo ""
echo "Done. Next steps:"
echo "  1. Upload wp-content/uploads/ from your PC (SFTP → $SITE_ROOT/wp-content/uploads/)"
echo "  2. In CloudPanel: enable SSL (Let's Encrypt) for $DOMAIN"
echo "  3. Open $PROD_URL and /online/online-order.php"
echo ""
