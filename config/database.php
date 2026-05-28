<?php
/**
 * SQLite database — stored inside public_html/db/ (protected by .htaccess)
 * Compatible with PHP 7.0+
 */

/* Path: public_html/db/titus.sqlite */
define('DB_PATH', dirname(__DIR__) . '/db/titus.sqlite');

function getDB() {
    static $pdo = null;
    if ($pdo !== null) { return $pdo; }
    try {
        $dir = dirname(DB_PATH);
        if (!is_dir($dir)) {
            mkdir($dir, 0755, true);
        }
        $pdo = new PDO('sqlite:' . DB_PATH, null, null, array(
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        ));
        $pdo->exec('PRAGMA journal_mode=WAL; PRAGMA foreign_keys=ON;');
    } catch (Exception $e) {
        error_log('DB error: ' . $e->getMessage());
        $pdo = null;
    }
    return $pdo;
}

function getServices($pdo) {
    if (!$pdo) { return array(); }
    try {
        return $pdo->query('SELECT * FROM services WHERE active=1 ORDER BY sort_order,id')->fetchAll();
    } catch (Exception $e) { return array(); }
}

function getTestimonials($pdo) {
    if (!$pdo) { return array(); }
    try {
        return $pdo->query('SELECT * FROM testimonials WHERE active=1 ORDER BY sort_order,id')->fetchAll();
    } catch (Exception $e) { return array(); }
}

function getListings($pdo, $featuredOnly = false, $limit = 6) {
    if (!$pdo) { return array(); }
    try {
        $where = $featuredOnly ? 'WHERE featured=1' : '';
        $stmt  = $pdo->prepare("SELECT * FROM listings $where ORDER BY sort_order,id LIMIT ?");
        $stmt->execute(array($limit));
        return $stmt->fetchAll();
    } catch (Exception $e) { return array(); }
}

function getGallery($pdo, $category = '') {
    if (!$pdo) { return array(); }
    try {
        if ($category) {
            $stmt = $pdo->prepare('SELECT * FROM gallery WHERE active=1 AND category=? ORDER BY sort_order,id');
            $stmt->execute(array($category));
        } else {
            $stmt = $pdo->query('SELECT * FROM gallery WHERE active=1 ORDER BY sort_order,id');
        }
        return $stmt->fetchAll();
    } catch (Exception $e) { return array(); }
}

function getSetting($key, $default = '') {
    $pdo = getDB();
    if (!$pdo) { return $default; }
    try {
        $stmt = $pdo->prepare('SELECT value FROM settings WHERE setting_key = ? LIMIT 1');
        $stmt->execute(array($key));
        $val = $stmt->fetchColumn();
        return $val !== false ? $val : $default;
    } catch (Exception $e) { return $default; }
}
