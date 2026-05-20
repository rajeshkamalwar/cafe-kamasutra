# Deploy Cafe Kamasutra on Hostinger VPS (CloudPanel)

Repo: https://github.com/rajeshkamalwar/cafe-kamasutra

## Part 1 — CloudPanel UI (do this first)

### 1. Add site

1. Click **+ ADD SITE**
2. **Domain:** `restaurantkamasutra.nl` (or your domain)
3. **PHP:** 8.2 (or 8.1+)
4. Create the site and wait until it is active

### 2. Create databases

CloudPanel → **Databases** → create:

| Database name | Notes |
|---------------|--------|
| `restaurant` | WordPress |
| `sharmakama` | Online ordering (`/online/`) — no underscores (CloudPanel) |

Create one MySQL user with access to **both** databases. Save host, user, and password.

### 3. SSL

Site → **SSL/TLS** → enable **Let's Encrypt** for your domain.

### 4. SSH access

CloudPanel → **SSH** / **Users** → note:

- Site user name (e.g. `restaurantkamasutra`)
- Site path: `/home/SITE_USER/htdocs/restaurantkamasutra.nl`

---

## Part 2 — SSH install (one command block)

SSH into the VPS as the **site user** (not root if CloudPanel restricts it):

```bash
cd ~/htdocs/restaurantkamasutra.nl

# Clone (first time only — empty site folder)
git clone https://github.com/rajeshkamalwar/cafe-kamasutra.git .

cp deploy/env.example deploy/env
nano deploy/env   # fill DOMAIN, SITE_ROOT, DB user/password

chmod +x deploy/cloudpanel-install.sh
./deploy/cloudpanel-install.sh
```

Edit `deploy/env` with your real values from CloudPanel:

```bash
DOMAIN=restaurantkamasutra.nl
SITE_ROOT=/home/YOUR_USER/htdocs/restaurantkamasutra.nl
WP_DB_NAME=restaurant
WP_DB_USER=your_mysql_user
WP_DB_PASS=your_mysql_password
WP_DB_HOST=127.0.0.1
ORDER_DB_NAME=sharmakama
ORDER_DB_USER=your_mysql_user
ORDER_DB_PASS=your_mysql_password
ORDER_DB_HOST=127.0.0.1
```

---

## Part 3 — Upload media (required)

`wp-content/uploads/` is **not** in Git (~420 MB).

From your Windows PC (PowerShell), upload with SFTP/WinSCP or:

```powershell
scp -r "C:\xampp\htdocs\cafekamasutra\wp-content\uploads" SITE_USER@YOUR_VPS_IP:/home/SITE_USER/htdocs/restaurantkamasutra.nl/wp-content/
```

---

## Part 4 — Verify

| URL | Expected |
|-----|----------|
| `https://restaurantkamasutra.nl/` | WordPress home |
| `https://restaurantkamasutra.nl/online/online-order.php` | Ordering |
| `https://restaurantkamasutra.nl/wp-admin/` | Admin login |

---

## Updates later

```bash
cd ~/htdocs/restaurantkamasutra.nl
git pull origin main
```

Re-import DB only if you intentionally replace production data.

---

## Troubleshooting

| Problem | Fix |
|---------|-----|
| Mixed content / wrong URLs | Re-run `wp search-replace` or check `deploy/env` `DOMAIN` |
| Online app DB error / 500 on `/online/` | Run `bash deploy/setup-ordering-db.sh`; fix `public_header.php` `<?php//` typo; `php deploy/diagnose-online-order.php` |
| Online app DB error | Check `online/admin/db-local.php` credentials and that `sharmakama` DB is imported |
| White screen | CloudPanel → PHP logs; ensure `wp-config.php` exists |
| 404 on `/online/` | Confirm files are in site root (not a subfolder) |
