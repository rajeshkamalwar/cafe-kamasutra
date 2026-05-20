#!/bin/bash
# Replace localhost URLs in the DB after importing from XAMPP.
set -euo pipefail
cd "$(dirname "$0")/.."

FROM_HTTP='http://localhost/cafekamasutra'
FROM_HTTPS='https://localhost/cafekamasutra'
TO='https://restaurantkamasutra.nl'

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

echo "==> Search-replace: $FROM_HTTP -> $TO"
$WP_CLI search-replace "$FROM_HTTP" "$TO" --all-tables --precise --skip-columns=guid --report-changed-only

echo "==> Search-replace: $FROM_HTTPS -> $TO"
$WP_CLI search-replace "$FROM_HTTPS" "$TO" --all-tables --precise --skip-columns=guid --report-changed-only

echo "==> Flush cache"
$WP_CLI cache flush 2>/dev/null || true

echo "Done. Hard-refresh https://restaurantkamasutra.nl/"
