<?php
/**
 * Database — SQLite (no MySQL server required, works on any cPanel)
 * The .db file is stored ONE level above public_html for security.
 * Path: /home/uwfuzcig/titus_db/titus.sqlite
 *
 * If that directory doesn't exist, cPanel File Manager → create it.
 * Then run setup.php once to build the tables.
 */
define('DB_PATH', dirname(__DIR__, 2) . '/titus_db/titus.sqlite');

function getDB(): ?PDO {
    static $pdo = null;
    if ($pdo !== null) { return $pdo; }
    try {
        $dir = dirname(DB_PATH);
        if (!is_dir($dir)) { mkdir($dir, 0750, true); }
        $pdo = new PDO('sqlite:' . DB_PATH, null, null, [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        ]);
        $pdo->exec('PRAGMA journal_mode=WAL; PRAGMA foreign_keys=ON;');
    } catch (PDOException $e) {
        error_log('SQLite connection failed: ' . $e->getMessage());
        $pdo = null;
    }
    return $pdo;
}

/* ── Helpers ── */
function getSetting(string $key, string $default = ''): string {
    $pdo = getDB();
    if (!$pdo) { return $default; }
    $stmt = $pdo->prepare("SELECT value FROM settings WHERE setting_key = ? LIMIT 1");
    $stmt->execute([$key]);
    $val = $stmt->fetchColumn();
    return $val !== false ? $val : $default;
}

function getServices(?PDO $pdo): array {
    if (!$pdo) { return []; }
    return $pdo->query("SELECT * FROM services WHERE active=1 ORDER BY sort_order,id")->fetchAll();
}

function getTestimonials(?PDO $pdo): array {
    if (!$pdo) { return []; }
    return $pdo->query("SELECT * FROM testimonials WHERE active=1 ORDER BY sort_order,id")->fetchAll();
}

function getListings(?PDO $pdo, bool $featuredOnly = false, int $limit = 6): array {
    if (!$pdo) { return []; }
    $where = $featuredOnly ? 'WHERE featured=1' : '';
    $stmt  = $pdo->prepare("SELECT * FROM listings $where ORDER BY sort_order,id LIMIT ?");
    $stmt->execute([$limit]);
    return $stmt->fetchAll();
}

function getGallery(?PDO $pdo, string $category = ''): array {
    if (!$pdo) { return []; }
    if ($category) {
        $stmt = $pdo->prepare("SELECT * FROM gallery WHERE active=1 AND category=? ORDER BY sort_order,id");
        $stmt->execute([$category]);
    } else {
        $stmt = $pdo->query("SELECT * FROM gallery WHERE active=1 ORDER BY sort_order,id");
    }
    return $stmt->fetchAll();
}
