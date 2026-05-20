# Cafe Kamasutra

WordPress site + `online/` ordering app (restaurantkamasutra.nl).

## Local setup (XAMPP)

1. Clone into `htdocs/cafekamasutra` (or your web root).
2. Copy config templates:
   - `wp-config.example.php` → `wp-config.php` (fill DB + salts)
   - `wp-config-local-sample.php` → `wp-config-local.php`
   - `online/admin/db-local-sample.php` → `online/admin/db-local.php`
   - `online/theme/db-local-sample.php` → `online/theme/db-local.php`
3. Import DB: see `local-databases-setup.sql`, then `database/restaurant.sql` and `database/sharma_kama.sql`.
4. Copy `wp-content/uploads/` from backup or production (not in Git).

## GitHub

https://github.com/rajeshkamalwar/cafe-kamasutra

## Deploy (Hostinger VPS)

1. On the server: `git clone` this repo into the web root.
2. Create `wp-config.php`, `db-local.php` files with production credentials (not in Git).
3. Import database and sync `wp-content/uploads/` (rsync/SFTP).
4. Point the domain document root to this folder; enable SSL in hPanel.

**Do not commit** `wp-config.php`, `wp-config-local.php`, or `*-local.php` — they are in `.gitignore`.
