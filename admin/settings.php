<?php
require_once '../config/database.php';
require_once '../config/auth.php';
requireAdminLogin();

$pdo           = getDB();
$admin_section = 'settings';
$admin_title   = 'Site Settings';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    verifyCsrf();

    /* Password change */
    if (!empty($_POST['new_password'])) {
        if (strlen($_POST['new_password']) < 8) {
            $_SESSION['flash_error'] = 'Password must be at least 8 characters.';
        } elseif ($_POST['new_password'] !== $_POST['confirm_password']) {
            $_SESSION['flash_error'] = 'Passwords do not match.';
        } else {
            $hash = password_hash($_POST['new_password'], PASSWORD_DEFAULT);
            $pdo->prepare("INSERT INTO settings (setting_key,value) VALUES ('admin_password_hash',?) ON CONFLICT(setting_key) DO UPDATE SET value=excluded.value")
                ->execute([$hash]);
            $_SESSION['flash_success'] = 'Password updated successfully.';
        }
        header('Location: settings.php');
        exit;
    }

    /* Save settings */
    $keys = [
        'hero_title','hero_subtitle','hero_cta_primary','hero_cta_secondary',
        'stat_years','stat_clients','stat_savings','stat_satisfaction',
        'about_title','about_text',
        'phone','email','address',
        'facebook','twitter','linkedin','instagram','youtube',
    ];
    $stmt = $pdo->prepare("INSERT INTO settings (setting_key,value) VALUES (?,?) ON CONFLICT(setting_key) DO UPDATE SET value=excluded.value");
    foreach ($keys as $k) {
        $stmt->execute([$k, trim($_POST[$k] ?? '')]);
    }
    $_SESSION['flash_success'] = 'Settings saved.';
    header('Location: settings.php');
    exit;
}

/* Load current settings */
$s = [];
$rows = $pdo->query("SELECT setting_key,value FROM settings")->fetchAll();
foreach ($rows as $r) { $s[$r['setting_key']] = $r['value']; }
$g = fn(string $k, string $d='') => $s[$k] ?? $d;

require_once 'includes/header.php';
?>

<div class="row g-4">
    <div class="col-lg-8">
        <form method="post" action="settings.php" class="admin-form">
            <input type="hidden" name="csrf_token" value="<?php echo csrfToken(); ?>">

            <!-- Hero -->
            <div class="admin-card mb-4">
                <div class="admin-card-header"><h2><i class="fas fa-image" style="color:#8FA9B5;margin-right:8px;"></i> Hero Section</h2></div>
                <div class="admin-card-body">
                    <div class="form-group">
                        <label>Hero Title (use \n for line break)</label>
                        <input type="text" name="hero_title" value="<?php echo htmlspecialchars($g('hero_title',"We Find. We Negotiate.\nYou Win.")); ?>">
                    </div>
                    <div class="form-group">
                        <label>Hero Subtitle</label>
                        <textarea name="hero_subtitle" rows="3"><?php echo htmlspecialchars($g('hero_subtitle')); ?></textarea>
                    </div>
                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label>Primary CTA Button Text</label>
                            <input type="text" name="hero_cta_primary" value="<?php echo htmlspecialchars($g('hero_cta_primary','Book Free Strategy Call')); ?>">
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Secondary CTA Button Text</label>
                            <input type="text" name="hero_cta_secondary" value="<?php echo htmlspecialchars($g('hero_cta_secondary','Our Services')); ?>">
                        </div>
                    </div>
                </div>
            </div>

            <!-- Stats -->
            <div class="admin-card mb-4">
                <div class="admin-card-header"><h2><i class="fas fa-chart-bar" style="color:#8FA9B5;margin-right:8px;"></i> Stats Bar</h2></div>
                <div class="admin-card-body">
                    <div class="row">
                        <div class="col-md-3 form-group"><label>Years</label><input type="text" name="stat_years" value="<?php echo htmlspecialchars($g('stat_years','5+')); ?>"></div>
                        <div class="col-md-3 form-group"><label>Clients</label><input type="text" name="stat_clients" value="<?php echo htmlspecialchars($g('stat_clients','100+')); ?>"></div>
                        <div class="col-md-3 form-group"><label>Avg. Savings</label><input type="text" name="stat_savings" value="<?php echo htmlspecialchars($g('stat_savings','$50K+')); ?>"></div>
                        <div class="col-md-3 form-group"><label>Satisfaction</label><input type="text" name="stat_satisfaction" value="<?php echo htmlspecialchars($g('stat_satisfaction','95%')); ?>"></div>
                    </div>
                </div>
            </div>

            <!-- About -->
            <div class="admin-card mb-4">
                <div class="admin-card-header"><h2><i class="fas fa-user" style="color:#8FA9B5;margin-right:8px;"></i> About Section</h2></div>
                <div class="admin-card-body">
                    <div class="form-group"><label>Section Title</label><input type="text" name="about_title" value="<?php echo htmlspecialchars($g('about_title')); ?>"></div>
                    <div class="form-group"><label>Section Text</label><textarea name="about_text" rows="4"><?php echo htmlspecialchars($g('about_text')); ?></textarea></div>
                </div>
            </div>

            <!-- Contact -->
            <div class="admin-card mb-4">
                <div class="admin-card-header"><h2><i class="fas fa-phone" style="color:#8FA9B5;margin-right:8px;"></i> Contact Info</h2></div>
                <div class="admin-card-body">
                    <div class="row">
                        <div class="col-md-4 form-group"><label>Phone</label><input type="text" name="phone" value="<?php echo htmlspecialchars($g('phone','+61 498 439 115')); ?>"></div>
                        <div class="col-md-4 form-group"><label>Email</label><input type="email" name="email" value="<?php echo htmlspecialchars($g('email','titus.buyersagent@gmail.com')); ?>"></div>
                        <div class="col-md-4 form-group"><label>Address</label><input type="text" name="address" value="<?php echo htmlspecialchars($g('address','Perth City, Western Australia')); ?>"></div>
                    </div>
                </div>
            </div>

            <!-- Social -->
            <div class="admin-card mb-4">
                <div class="admin-card-header"><h2><i class="fas fa-share-alt" style="color:#8FA9B5;margin-right:8px;"></i> Social Media Links</h2></div>
                <div class="admin-card-body">
                    <div class="row">
                        <?php foreach (['facebook'=>'Facebook','twitter'=>'Twitter / X','linkedin'=>'LinkedIn','instagram'=>'Instagram','youtube'=>'YouTube'] as $k=>$l): ?>
                        <div class="col-md-6 form-group">
                            <label><?php echo $l; ?></label>
                            <input type="url" name="<?php echo $k; ?>" value="<?php echo htmlspecialchars($g($k)); ?>" placeholder="https://...">
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>

            <button type="submit" class="btn-save" style="font-size:16px;padding:14px 36px;">
                <i class="fas fa-save"></i> Save All Settings
            </button>
        </form>
    </div>

    <!-- Change password -->
    <div class="col-lg-4">
        <div class="admin-card">
            <div class="admin-card-header"><h2><i class="fas fa-lock" style="color:#e74c3c;margin-right:8px;"></i> Change Password</h2></div>
            <div class="admin-card-body">
                <form method="post" action="settings.php" class="admin-form" autocomplete="off">
                    <input type="hidden" name="csrf_token" value="<?php echo csrfToken(); ?>">
                    <div class="form-group">
                        <label>New Password (min 8 chars)</label>
                        <input type="password" name="new_password" required minlength="8" autocomplete="new-password">
                    </div>
                    <div class="form-group">
                        <label>Confirm Password</label>
                        <input type="password" name="confirm_password" required minlength="8" autocomplete="new-password">
                    </div>
                    <button type="submit" class="btn-save" style="background:#e74c3c;width:100%;">
                        <i class="fas fa-key"></i> Update Password
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<?php require_once 'includes/footer.php'; ?>
