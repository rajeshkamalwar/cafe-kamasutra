#!/bin/bash
set -euo pipefail
cd "$(dirname "$0")/.."
if [[ -f deploy/env ]]; then
	set -a
	# shellcheck disable=SC1091
	source deploy/env
	set +a
fi
php deploy/write-wp-config.php
