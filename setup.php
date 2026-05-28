<?php
/**
 * ============================================================
 * SETUP — run once, then DELETE this file from the server.
 * Visit: https://yourdomain.com/setup.php
 * ============================================================
 */
require_once __DIR__ . '/config/database.php';

$pdo = getDB();
if (!$pdo) {
    die('<h2 style="color:red;font-family:sans-serif;">❌ Cannot open SQLite database. Check that the directory <code>' . dirname(DB_PATH) . '</code> is writable by PHP.</h2>');
}

/* ── Create tables (SQLite syntax) ── */
$pdo->exec("
CREATE TABLE IF NOT EXISTS settings (
    id          INTEGER PRIMARY KEY AUTOINCREMENT,
    setting_key TEXT UNIQUE NOT NULL,
    value       TEXT,
    updated_at  TEXT DEFAULT (datetime('now'))
);

CREATE TABLE IF NOT EXISTS services (
    id          INTEGER PRIMARY KEY AUTOINCREMENT,
    title       TEXT NOT NULL,
    description TEXT,
    icon        TEXT DEFAULT 'far fa-star',
    image       TEXT,
    sort_order  INTEGER DEFAULT 0,
    active      INTEGER DEFAULT 1,
    created_at  TEXT DEFAULT (datetime('now'))
);

CREATE TABLE IF NOT EXISTS listings (
    id          INTEGER PRIMARY KEY AUTOINCREMENT,
    title       TEXT NOT NULL,
    address     TEXT,
    suburb      TEXT,
    price       TEXT,
    bedrooms    INTEGER DEFAULT 0,
    bathrooms   INTEGER DEFAULT 0,
    car_spaces  INTEGER DEFAULT 0,
    description TEXT,
    image       TEXT,
    status      TEXT DEFAULT 'available' CHECK (status IN ('available','sold','under_offer')),
    featured    INTEGER DEFAULT 0,
    sort_order  INTEGER DEFAULT 0,
    created_at  TEXT DEFAULT (datetime('now'))
);

CREATE TABLE IF NOT EXISTS testimonials (
    id         INTEGER PRIMARY KEY AUTOINCREMENT,
    name       TEXT NOT NULL,
    role       TEXT,
    text       TEXT,
    photo      TEXT,
    rating     INTEGER DEFAULT 5,
    active     INTEGER DEFAULT 1,
    sort_order INTEGER DEFAULT 0,
    created_at TEXT DEFAULT (datetime('now'))
);

CREATE TABLE IF NOT EXISTS gallery (
    id         INTEGER PRIMARY KEY AUTOINCREMENT,
    caption    TEXT,
    image      TEXT NOT NULL,
    category   TEXT DEFAULT 'general',
    sort_order INTEGER DEFAULT 0,
    active     INTEGER DEFAULT 1,
    created_at TEXT DEFAULT (datetime('now'))
);
");

/* ── Seed settings ── */
$adminHash = password_hash('TitusBuyers2025!', PASSWORD_DEFAULT);

$defaults = [
    ['admin_password_hash',   $adminHash],
    ['hero_title',            "We Find. We Negotiate.\nYou Win."],
    ['hero_subtitle',         "Stop searching alone. Perth's trusted buyers advocate secures properties below market value — saving you months and tens of thousands of dollars."],
    ['hero_cta_primary',      'Book Free Strategy Call'],
    ['hero_cta_secondary',    'Our Services'],
    ['stat_years',            '5+'],
    ['stat_clients',          '100+'],
    ['stat_savings',          '$50K+'],
    ['stat_satisfaction',     '95%'],
    ['about_title',           "Perth's Premier Property Buyers Advocates"],
    ['about_text',            "At Titus Tuitoek Buyers Agent, we specialise in guiding clients through the Perth real estate market with personalised services tailored to every buyer."],
    ['phone',                 '+61 498 439 115'],
    ['email',                 'titus.buyersagent@gmail.com'],
    ['address',               'Perth City, Western Australia'],
    ['facebook',              'https://facebook.com/titusbuyersagent'],
    ['twitter',               'https://twitter.com/titusbuyersagent'],
    ['linkedin',              'https://linkedin.com/in/titustuitoek'],
    ['instagram',             'https://instagram.com/titusbuyersagent'],
    ['youtube',               'https://youtube.com/@titusbuyersagent'],
];
$stmt = $pdo->prepare("INSERT OR IGNORE INTO settings (setting_key,value) VALUES (?,?)");
foreach ($defaults as [$k,$v]) { $stmt->execute([$k,$v]); }

/* ── Seed services ── */
$svcs = [
    ['Full Buying Service',    'End-to-end property acquisition from initial consultation to settlement.',      'far fa-home',       1],
    ['Property Search',        'Targeted search with exclusive access to off-market opportunities.',            'far fa-search',     2],
    ['Property Evaluation',    'Comprehensive assessment of value, condition, and investment potential.',       'far fa-chart-bar',  3],
    ['Negotiation & Bidding',  'Expert negotiation to secure properties at the best possible price.',           'far fa-handshake',  4],
    ['Auction Representation', 'Strategic bidding by experienced professionals who understand auction dynamics.','far fa-gavel',     5],
    ['Due Diligence',          'Thorough investigation of titles, zoning, and potential issues.',               'far fa-shield-alt', 6],
    ['Investment Strategy',    'Personalised strategies aligned with your financial goals.',                    'far fa-chart-line', 7],
    ['Settlement Support',     'Coordinating with conveyancers and lenders for smooth settlement.',             'far fa-file-alt',   8],
];
$stmt = $pdo->prepare("INSERT OR IGNORE INTO services (title,description,icon,sort_order) VALUES (?,?,?,?)");
foreach ($svcs as $s) { $stmt->execute($s); }

/* ── Seed testimonials ── */
$tests = [
    ['Sarah & James Wilson', 'First Home Buyers, Scarborough', 'Working with Titus was the best decision we made. His market knowledge saved us over $45,000 on our dream home.',       5, 1],
    ['Michael Chen',          'Property Investor, Subiaco',    'Titus found me a property with 7% yield I never would have found on my own. He made buying interstate seamless.',        5, 2],
    ['Emily & David Park',    'Upsizing Family, Nedlands',     'We were outbid at three auctions before Titus stepped in. He secured our dream home $30,000 under the asking price.',   5, 3],
];
$stmt = $pdo->prepare("INSERT OR IGNORE INTO testimonials (name,role,text,rating,sort_order) VALUES (?,?,?,?,?)");
foreach ($tests as $t) { $stmt->execute($t); }

echo '<!DOCTYPE html><html><head><meta charset="utf-8">
<style>
body{font-family:sans-serif;max-width:620px;margin:60px auto;padding:0 20px;background:#f4f8fa;}
h2{color:#27ae60;} .box{background:#fff;border-radius:10px;padding:24px;margin:16px 0;box-shadow:0 2px 8px rgba(0,0,0,.08);}
.warn{border-left:4px solid #e74c3c;background:#fde8e8;} .ok{border-left:4px solid #27ae60;}
code{background:#eee;padding:2px 6px;border-radius:3px;font-size:13px;}
a{color:#8FA9B5;font-weight:700;}
</style></head><body>
<h2>✅ Setup complete!</h2>
<div class="box ok">
    <strong>SQLite database created</strong> at:<br>
    <code>' . htmlspecialchars(DB_PATH) . '</code><br><br>
    Tables: <code>settings</code>, <code>services</code>, <code>listings</code>, <code>testimonials</code>, <code>gallery</code>
</div>
<div class="box ok">
    <strong>Admin credentials</strong><br>
    URL: <a href="admin/login.php">/admin/login.php</a><br>
    Password: <code>TitusBuyers2025!</code><br>
    <small>Change this in Admin → Settings after first login.</small>
</div>
<div class="box warn">
    ⚠️ <strong>Delete setup.php now!</strong><br>
    Go to cPanel File Manager and remove <code>setup.php</code> from your public_html folder.
</div>
<p><a href="index.php">← Go to website</a> &nbsp;|&nbsp; <a href="admin/login.php">→ Admin panel</a></p>
</body></html>';
