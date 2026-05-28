<?php
if (session_status() === PHP_SESSION_NONE) { session_start(); }

const ADMIN_SESSION_KEY  = 'tba_admin';
const ADMIN_SESSION_TIME = 7200; // 2 hours

function isAdminLoggedIn(): bool {
    if (empty($_SESSION[ADMIN_SESSION_KEY])) { return false; }
    if (time() - ($_SESSION['tba_last_active'] ?? 0) > ADMIN_SESSION_TIME) {
        session_destroy();
        return false;
    }
    $_SESSION['tba_last_active'] = time();
    return true;
}

function requireAdminLogin(): void {
    if (!isAdminLoggedIn()) {
        header('Location: login.php');
        exit;
    }
}

function attemptLogin(string $password): bool {
    require_once __DIR__ . '/database.php';
    $hash = getSetting('admin_password_hash');
    if ($hash && password_verify($password, $hash)) {
        session_regenerate_id(true);
        $_SESSION[ADMIN_SESSION_KEY]  = true;
        $_SESSION['tba_last_active'] = time();
        return true;
    }
    return false;
}

function adminLogout(): void {
    session_destroy();
    header('Location: login.php');
    exit;
}

/* CSRF helpers */
function csrfToken(): string {
    if (empty($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }
    return $_SESSION['csrf_token'];
}

function verifyCsrf(): void {
    $token = $_POST['csrf_token'] ?? '';
    if (!hash_equals($_SESSION['csrf_token'] ?? '', $token)) {
        http_response_code(403);
        die('Invalid CSRF token.');
    }
}
