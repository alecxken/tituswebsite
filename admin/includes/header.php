<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="robots" content="noindex,nofollow">
<title><?php echo isset($admin_title) ? htmlspecialchars($admin_title) . ' — Admin' : 'Admin Panel'; ?> | Titus Buyers Agent</title>
<link rel="icon" href="../assets/images/logo-2.png">
<!-- Bootstrap 5 (self-hosted would be ideal; for admin only this CDN is acceptable) -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous">
<link href="../assets/css/quicksand.css" rel="stylesheet">
<style>
:root {
    --brand: #8FA9B5;
    --dark:  #0d1b2a;
    --sidebar-w: 260px;
    --font: 'Quicksand', sans-serif;
}
*, *::before, *::after { box-sizing: border-box; }
body { font-family: var(--font); background: #f0f4f7; margin: 0; }

/* Sidebar */
.admin-sidebar {
    position: fixed; top: 0; left: 0;
    width: var(--sidebar-w); height: 100vh;
    background: var(--dark); overflow-y: auto;
    display: flex; flex-direction: column;
    z-index: 1000;
}
.sidebar-brand {
    padding: 24px 20px;
    border-bottom: 1px solid rgba(255,255,255,.08);
    display: flex; align-items: center; gap: 12px;
}
.sidebar-brand img { height: 40px; }
.sidebar-brand span { color: #fff; font-size: 14px; font-weight: 700; line-height: 1.3; }
.sidebar-nav { padding: 16px 0; flex: 1; }
.sidebar-nav a {
    display: flex; align-items: center; gap: 12px;
    padding: 12px 20px; color: rgba(255,255,255,.65);
    font-size: 14px; font-weight: 600; text-decoration: none;
    transition: all .2s ease; border-left: 3px solid transparent;
}
.sidebar-nav a:hover,
.sidebar-nav a.active {
    color: #fff;
    background: rgba(143,169,181,.12);
    border-left-color: var(--brand);
}
.sidebar-nav a i { width: 18px; text-align: center; font-size: 15px; }
.sidebar-nav .nav-section {
    font-size: 10px; font-weight: 700; letter-spacing: 2px;
    text-transform: uppercase; color: rgba(255,255,255,.3);
    padding: 20px 20px 8px;
}
.sidebar-footer {
    padding: 16px 20px;
    border-top: 1px solid rgba(255,255,255,.08);
}
.sidebar-footer a {
    display: flex; align-items: center; gap: 10px;
    color: rgba(255,255,255,.5); font-size: 13px; text-decoration: none;
    transition: color .2s;
}
.sidebar-footer a:hover { color: #e74c3c; }

/* Main content */
.admin-main {
    margin-left: var(--sidebar-w);
    min-height: 100vh;
    display: flex; flex-direction: column;
}
.admin-topbar {
    background: #fff;
    padding: 14px 28px;
    border-bottom: 1px solid #e0e8ed;
    display: flex; align-items: center; justify-content: space-between;
    position: sticky; top: 0; z-index: 100;
}
.admin-topbar h1 {
    font-size: 20px; font-weight: 700; color: var(--dark); margin: 0;
}
.topbar-right { display: flex; align-items: center; gap: 12px; }
.topbar-right a {
    font-size: 13px; font-weight: 600;
    color: #6c8795; text-decoration: none;
    display: flex; align-items: center; gap: 6px;
}
.topbar-right a:hover { color: var(--brand); }
.admin-content { padding: 28px; flex: 1; }

/* Cards & tables */
.admin-card {
    background: #fff;
    border-radius: 12px;
    box-shadow: 0 2px 12px rgba(0,0,0,.06);
    overflow: hidden;
}
.admin-card-header {
    padding: 18px 24px;
    border-bottom: 1px solid #f0f4f7;
    display: flex; align-items: center; justify-content: space-between;
}
.admin-card-header h2 {
    font-size: 16px; font-weight: 700; color: var(--dark); margin: 0;
}
.admin-card-body { padding: 24px; }
.admin-table { width: 100%; border-collapse: collapse; }
.admin-table th {
    font-size: 11px; font-weight: 700; letter-spacing: 1px;
    text-transform: uppercase; color: #8fa4b0;
    padding: 10px 16px; text-align: left;
    border-bottom: 1px solid #f0f4f7;
    background: #fafcfd;
}
.admin-table td {
    padding: 14px 16px; font-size: 14px; color: #2c3e50;
    border-bottom: 1px solid #f0f4f7; vertical-align: middle;
}
.admin-table tr:last-child td { border-bottom: none; }
.admin-table tr:hover td { background: #fafcfd; }
.badge-active   { background: #d4f4e2; color: #1a7a45; font-size: 11px; font-weight: 700; padding: 4px 10px; border-radius: 50px; }
.badge-inactive { background: #fde8e8; color: #c0392b; font-size: 11px; font-weight: 700; padding: 4px 10px; border-radius: 50px; }
.btn-sm-brand {
    display: inline-flex; align-items: center; gap: 5px;
    padding: 6px 14px; background: var(--brand); color: #fff;
    border: none; border-radius: 6px; font-family: var(--font);
    font-size: 12px; font-weight: 700; cursor: pointer; text-decoration: none;
    transition: background .2s;
}
.btn-sm-brand:hover { background: #6d8a98; color: #fff; }
.btn-sm-danger {
    display: inline-flex; align-items: center; gap: 5px;
    padding: 6px 14px; background: #fde8e8; color: #c0392b;
    border: none; border-radius: 6px; font-family: var(--font);
    font-size: 12px; font-weight: 700; cursor: pointer; text-decoration: none;
    transition: background .2s;
}
.btn-sm-danger:hover { background: #e74c3c; color: #fff; }

/* Form fields */
.admin-form label { font-size: 13px; font-weight: 700; color: #4a6a79; margin-bottom: 6px; display: block; }
.admin-form input[type=text],
.admin-form input[type=email],
.admin-form input[type=number],
.admin-form input[type=url],
.admin-form input[type=password],
.admin-form select,
.admin-form textarea {
    width: 100%; padding: 10px 14px;
    border: 1.5px solid #dde8ed; border-radius: 8px;
    font-family: var(--font); font-size: 14px; color: #2c3e50;
    transition: border-color .2s;
}
.admin-form input:focus,
.admin-form select:focus,
.admin-form textarea:focus {
    outline: none; border-color: var(--brand);
    box-shadow: 0 0 0 3px rgba(143,169,181,.15);
}
.admin-form .form-group { margin-bottom: 20px; }
.btn-save {
    padding: 12px 28px; background: var(--brand); color: #fff;
    border: none; border-radius: 8px; font-family: var(--font);
    font-size: 15px; font-weight: 700; cursor: pointer; transition: background .2s;
}
.btn-save:hover { background: #6d8a98; }

/* Alert */
.flash-msg {
    padding: 14px 18px; border-radius: 8px;
    margin-bottom: 20px; font-size: 14px; font-weight: 600;
}
.flash-success { background: #d4f4e2; border-left: 4px solid #27ae60; color: #1a5c35; }
.flash-error   { background: #fde8e8; border-left: 4px solid #e74c3c; color: #7a1a1a; }

/* Image previews */
.img-preview { width: 70px; height: 55px; object-fit: cover; border-radius: 6px; }

/* Responsive */
@media (max-width: 768px) {
    .admin-sidebar { transform: translateX(-100%); }
    .admin-main    { margin-left: 0; }
}
</style>
</head>
<body>

<!-- Sidebar -->
<aside class="admin-sidebar" aria-label="Admin navigation">
    <div class="sidebar-brand">
        <img src="../assets/images/logo-2.png" alt="Titus Buyers Agent">
        <span>Buyers Agent<br>Admin Panel</span>
    </div>
    <nav class="sidebar-nav" aria-label="Admin menu">
        <div class="nav-section">Main</div>
        <a href="index.php" class="<?php echo ($admin_section??'')==='dashboard' ? 'active':'' ?>">
            <i class="fas fa-tachometer-alt"></i> Dashboard
        </a>
        <div class="nav-section">Content</div>
        <a href="services.php" class="<?php echo ($admin_section??'')==='services' ? 'active':'' ?>">
            <i class="fas fa-concierge-bell"></i> Services
        </a>
        <a href="listings.php" class="<?php echo ($admin_section??'')==='listings' ? 'active':'' ?>">
            <i class="fas fa-home"></i> Listings
        </a>
        <a href="testimonials.php" class="<?php echo ($admin_section??'')==='testimonials' ? 'active':'' ?>">
            <i class="fas fa-quote-right"></i> Testimonials
        </a>
        <a href="gallery.php" class="<?php echo ($admin_section??'')==='gallery' ? 'active':'' ?>">
            <i class="fas fa-images"></i> Gallery / Photos
        </a>
        <div class="nav-section">Configuration</div>
        <a href="settings.php" class="<?php echo ($admin_section??'')==='settings' ? 'active':'' ?>">
            <i class="fas fa-cog"></i> Site Settings
        </a>
        <a href="../index.php" target="_blank">
            <i class="fas fa-external-link-alt"></i> View Website
        </a>
    </nav>
    <div class="sidebar-footer">
        <a href="logout.php"><i class="fas fa-sign-out-alt"></i> Log Out</a>
    </div>
</aside>

<!-- Main -->
<div class="admin-main">
    <div class="admin-topbar">
        <h1><?php echo isset($admin_title) ? htmlspecialchars($admin_title) : 'Dashboard'; ?></h1>
        <div class="topbar-right">
            <a href="../index.php" target="_blank"><i class="fas fa-globe"></i> View Site</a>
            <a href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a>
        </div>
    </div>
    <div class="admin-content">
<?php
/* Flash messages */
if (!empty($_SESSION['flash_success'])): ?>
<div class="flash-msg flash-success"><?php echo htmlspecialchars($_SESSION['flash_success']); unset($_SESSION['flash_success']); ?></div>
<?php endif; ?>
<?php if (!empty($_SESSION['flash_error'])): ?>
<div class="flash-msg flash-error"><?php echo htmlspecialchars($_SESSION['flash_error']); unset($_SESSION['flash_error']); ?></div>
<?php endif; ?>
