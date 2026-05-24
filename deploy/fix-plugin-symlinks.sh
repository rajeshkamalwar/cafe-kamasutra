#!/bin/bash
# Active plugins in DB use folder names without _bkp; repo keeps _bkp copies.
set -e
cd "$(dirname "$0")/.."
PLUGINS=wp-content/plugins

link_if_missing() {
  local target=$1
  local link=$2
  if [ -d "$PLUGINS/$target" ] && [ ! -e "$PLUGINS/$link" ]; then
    ln -s "$target" "$PLUGINS/$link"
    echo "Linked $link -> $target"
  fi
}

link_if_missing "seo-by-rank-math_bkp" "seo-by-rank-math"
link_if_missing "login-security-recaptcha_bkp" "login-security-recaptcha"
link_if_missing "better-wp-security_bkp" "better-wp-security"

echo "Done."
