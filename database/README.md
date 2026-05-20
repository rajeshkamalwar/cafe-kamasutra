# Database dumps

MariaDB exports for local / VPS restore.

| File | Database | Purpose |
|------|----------|---------|
| `restaurant.sql` | `restaurant` | WordPress (`wpcm_*` tables) |
| `sharma_kama.sql` | `sharma_kama` | Online ordering app (`online/`) |

## Restore (Hostinger VPS / XAMPP)

```bash
mysql -u root -p < local-databases-setup.sql   # creates empty DBs (from project root)
mysql -u root -p restaurant < database/restaurant.sql
mysql -u root -p sharma_kama < database/sharma_kama.sql
```

On production, create databases and users in hPanel first, then import with the production credentials.

## Notes

- Exported from local XAMPP MariaDB.
- `restaurant.sql` may skip `wpcm_revslider_css_bkp` if that table is corrupted locally (RevSlider backup table; not required for the site).
- After import on a new domain, run WordPress URL search-replace (WP-CLI or Better Search Replace plugin) from `http://localhost/cafekamasutra` to your live URL.
- Contains customer/order data — treat as sensitive.

## Re-export locally

```bash
mysqldump -u root --force --single-transaction --routines --triggers --add-drop-table restaurant > database/restaurant.sql
mysqldump -u root --single-transaction --routines --triggers --add-drop-table sharma_kama > database/sharma_kama.sql
```
