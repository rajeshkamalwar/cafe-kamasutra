#!/bin/bash
# Replace all localhost/XAMPP URLs after importing from local dev.
set -euo pipefail
cd "$(dirname "$0")/.."

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

# Order matters: longest / most specific first
REPLACEMENTS=(
	"http://localhost/cafekamasutra"
	"https://localhost/cafekamasutra"
	"//localhost/cafekamasutra"
	"http://localhost"
	"https://localhost"
)

for FROM in "${REPLACEMENTS[@]}"; do
	echo "==> search-replace: $FROM -> $TO"
	$WP_CLI search-replace "$FROM" "$TO" --all-tables --precise --skip-columns=guid --report-changed-only || true
done

echo "==> Flush caches"
$WP_CLI cache flush 2>/dev/null || true
$WP_CLI transient delete --all 2>/dev/null || true

echo ""
echo "Done. Hard-refresh https://restaurantkamasutra.nl/ (Ctrl+Shift+R)"
echo "If RevSlider still broken: WP Admin -> Slider Revolution -> clear cache"
