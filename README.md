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

## Deploy (Hostinger VPS + CloudPanel)

**Full guide:** [deploy/CLOUDPANEL.md](deploy/CLOUDPANEL.md)

1. CloudPanel → **+ ADD SITE** → domain + PHP 8.2
2. Create MySQL databases `restaurant` + `sharma_kama`
3. SSH: `git clone` + `./deploy/cloudpanel-install.sh` (see `deploy/env.example`)
4. SFTP `wp-content/uploads/` from your PC
5. Enable SSL in CloudPanel

**Do not commit** `wp-config.php`, `wp-config-local.php`, or `*-local.php` — they are in `.gitignore`.
