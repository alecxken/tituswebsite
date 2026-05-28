<?php
require_once '../config/database.php';
require_once '../config/auth.php';
requireAdminLogin();

$admin_title   = 'Dashboard';
$admin_section = 'dashboard';
$pdo = getDB();

/* Stats */
$counts = ['services'=>0,'listings'=>0,'testimonials'=>0,'gallery'=>0];
if ($pdo) {
    foreach (array_keys($counts) as $tbl) {
        $counts[$tbl] = (int)$pdo->query("SELECT COUNT(*) FROM $tbl")->fetchColumn();
    }
}
require_once 'includes/header.php';
?>

<div class="row g-4 mb-4">
    <?php
    $cards = [
        ['services',     'Services',     'fas fa-concierge-bell', 'services.php',     '#8FA9B5'],
        ['listings',     'Listings',     'fas fa-home',           'listings.php',     '#27ae60'],
        ['testimonials', 'Testimonials', 'fas fa-quote-right',    'testimonials.php', '#f39c12'],
        ['gallery',      'Gallery Items','fas fa-images',         'gallery.php',      '#9b59b6'],
    ];
    foreach ($cards as [$key, $label, $icon, $url, $color]):
    ?>
    <div class="col-md-6 col-xl-3">
        <a href="<?php echo $url; ?>" style="text-decoration:none;">
            <div class="admin-card p-4 d-flex align-items-center gap-3">
                <div style="width:56px;height:56px;border-radius:12px;background:<?php echo $color; ?>20;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                    <i class="<?php echo $icon; ?>" style="font-size:22px;color:<?php echo $color; ?>;"></i>
                </div>
                <div>
                    <div style="font-size:28px;font-weight:800;color:#0d1b2a;line-height:1;"><?php echo $counts[$key]; ?></div>
                    <div style="font-size:13px;color:#6c8795;font-weight:600;"><?php echo $label; ?></div>
                </div>
            </div>
        </a>
    </div>
    <?php endforeach; ?>
</div>

<div class="row g-4">
    <div class="col-lg-6">
        <div class="admin-card">
            <div class="admin-card-header">
                <h2>Quick Actions</h2>
            </div>
            <div class="admin-card-body d-flex flex-column gap-3">
                <a href="services.php?action=add"     class="btn-sm-brand" style="padding:12px 18px;font-size:14px;"><i class="fas fa-plus"></i> Add New Service</a>
                <a href="listings.php?action=add"     class="btn-sm-brand" style="padding:12px 18px;font-size:14px;"><i class="fas fa-plus"></i> Add New Listing</a>
                <a href="testimonials.php?action=add" class="btn-sm-brand" style="padding:12px 18px;font-size:14px;"><i class="fas fa-plus"></i> Add Testimonial</a>
                <a href="gallery.php?action=add"      class="btn-sm-brand" style="padding:12px 18px;font-size:14px;"><i class="fas fa-plus"></i> Upload Photo</a>
                <a href="settings.php"                class="btn-sm-brand" style="padding:12px 18px;font-size:14px;background:#4a6a79;"><i class="fas fa-cog"></i> Site Settings</a>
            </div>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="admin-card">
            <div class="admin-card-header">
                <h2>Help & Tips</h2>
            </div>
            <div class="admin-card-body">
                <ul style="font-size:14px;color:#4a6a79;line-height:2;padding-left:18px;margin:0;">
                    <li><strong>Services</strong> — add/edit/delete the services shown on the website</li>
                    <li><strong>Listings</strong> — showcase properties you've secured for clients</li>
                    <li><strong>Testimonials</strong> — manage client reviews shown on the homepage</li>
                    <li><strong>Gallery</strong> — upload photos used across the site</li>
                    <li><strong>Settings</strong> — update hero text, contact info, social links &amp; password</li>
                </ul>
                <hr style="margin:20px 0;border-color:#f0f4f7;">
                <p style="font-size:13px;color:#8fa4b0;margin:0;">Default password: <code>TitusBuyers2025!</code> — change it in Settings.</p>
            </div>
        </div>
    </div>
</div>

<?php require_once 'includes/footer.php'; ?>
