#!/bin/bash
# Fix homepage hero: footer PHP fatal stops RevSlider JS from initializing.
set -e
cd "$(dirname "$0")/.."

git pull origin main 2>/dev/null || true
bash deploy/fix-plugin-symlinks.sh

echo "=== Homepage footer check ==="
if curl -sf "https://restaurantkamasutra.nl/" | grep -q "There has been a critical error"; then
  echo "Still has critical error. Enable debug log:"
  php deploy/enable-wp-debug-log.php 2>/dev/null || true
  curl -sf "https://restaurantkamasutra.nl/" >/dev/null || true
  tail -20 wp-content/debug.log 2>/dev/null || echo "(no debug.log yet)"
  echo ""
  echo "Run: php deploy/diagnose-wp-footer.php"
  exit 1
fi

if curl -sf "https://restaurantkamasutra.nl/" | grep -q "rs-initialisation-scripts"; then
  echo "OK: RevSlider init scripts present. Hard-refresh the site."
else
  echo "No critical error, but RevSlider init script missing — check plugin active."
  exit 1
fi
