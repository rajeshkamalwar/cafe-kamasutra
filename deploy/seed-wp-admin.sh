#!/bin/bash
# Create or reset WordPress administrator login (run on VPS or local from site root).
# Credentials come from deploy/env — never commit deploy/env.
set -euo pipefail

SCRIPT_DIR="$(cd "$(dirname "${BASH_SOURCE[0]}")" && pwd)"
PROJECT_ROOT="$(dirname "$SCRIPT_DIR")"
cd "$PROJECT_ROOT"

if [[ -f "$SCRIPT_DIR/env" ]]; then
	# shellcheck disable=SC1091
	source "$SCRIPT_DIR/env"
fi

DOMAIN="${DOMAIN:-restaurantkamasutra.nl}"
WP_ADMIN_USER="${WP_ADMIN_USER:-admin}"
WP_ADMIN_EMAIL="${WP_ADMIN_EMAIL:-info@restaurantkamasutra.nl}"
WP_ADMIN_PASS="${WP_ADMIN_PASS:-admin123}"
WP_ADMIN_DISPLAY_NAME="${WP_ADMIN_DISPLAY_NAME:-Restaurant Admin}"

if [[ -z "$WP_ADMIN_PASS" || "$WP_ADMIN_PASS" == "CHANGE_ME" ]]; then
	echo "ERROR: Set WP_ADMIN_PASS in deploy/env (e.g. admin123)"
	exit 1
fi

if [[ ! -f wp-config.php ]]; then
	echo "ERROR: wp-config.php missing. Run: php deploy/write-wp-config.php"
	exit 1
fi

WP_CLI=""
if command -v wp >/dev/null 2>&1; then
	WP_CLI="wp"
elif [[ -f wp-cli.phar ]]; then
	WP_CLI="php wp-cli.phar"
else
	echo "==> Downloading WP-CLI..."
	curl -fsSL -o wp-cli.phar https://raw.githubusercontent.com/wp-cli/builds/gh-pages/phar/wp-cli.phar
	WP_CLI="php wp-cli.phar"
fi

EXISTING_ID=""
if EXISTING_ID="$($WP_CLI user get "$WP_ADMIN_USER" --field=ID 2>/dev/null)"; then
	echo "==> Updating existing user: $WP_ADMIN_USER (ID $EXISTING_ID)"
	$WP_CLI user update "$WP_ADMIN_USER" \
		--user_pass="$WP_ADMIN_PASS" \
		--display_name="$WP_ADMIN_DISPLAY_NAME" \
		--role=administrator
	EMAIL_OWNER="$($WP_CLI user get "$WP_ADMIN_EMAIL" --field=ID 2>/dev/null || true)"
	if [[ -z "$EMAIL_OWNER" || "$EMAIL_OWNER" == "$EXISTING_ID" ]]; then
		$WP_CLI user update "$WP_ADMIN_USER" --user_email="$WP_ADMIN_EMAIL" || true
	fi
else
	CREATE_EMAIL="$WP_ADMIN_EMAIL"
	if $WP_CLI user get "$WP_ADMIN_EMAIL" --field=ID >/dev/null 2>&1; then
		CREATE_EMAIL="wp-admin@${DOMAIN}"
	fi
	echo "==> Creating administrator: $WP_ADMIN_USER ($CREATE_EMAIL)"
	$WP_CLI user create "$WP_ADMIN_USER" "$CREATE_EMAIL" \
		--user_pass="$WP_ADMIN_PASS" \
		--display_name="$WP_ADMIN_DISPLAY_NAME" \
		--role=administrator \
		--porcelain
fi

echo ""
echo "WordPress admin ready."
echo "  URL:      https://${DOMAIN}/wp-login.php"
echo "  Username: ${WP_ADMIN_USER}"
echo "  Email:    ${WP_ADMIN_EMAIL}"
echo "  Password: (value of WP_ADMIN_PASS in deploy/env)"
echo ""
echo "Other users in DB (passwords unknown unless reset): kaamsutra_surya"
echo "Reset another user: php wp-cli.phar user update USERNAME --user_pass='...'"
