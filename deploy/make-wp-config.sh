#!/bin/bash
set -euo pipefail
cd "$(dirname "$0")/.."
[[ -f deploy/env ]] && source deploy/env
php deploy/write-wp-config.php
