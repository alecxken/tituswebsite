<?php
require_once '../config/database.php';
require_once '../config/auth.php';
requireAdminLogin();

$pdo           = getDB();
$admin_section = 'gallery';
$action        = $_GET['action'] ?? 'list';
$id            = (int)($_GET['id'] ?? 0);

/* ── Multi-file upload ── */
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['images'])) {
    verifyCsrf();
    $category   = trim($_POST['category']   ?? 'general');
    $sort_order = (int)($_POST['sort_order'] ?? 0);
    $uploaded   = 0;
    $files = $_FILES['images'];
    foreach ($files['tmp_name'] as $i => $tmp) {
        if (empty($tmp)) { continue; }
        $ext = strtolower(pathinfo($files['name'][$i], PATHINFO_EXTENSION));
        if (!in_array($ext, ['jpg','jpeg','png','webp'], true) || $files['size'][$i] > 5_000_000) { continue; }
        $fname = 'gal_' . uniqid() . '.' . $ext;
        if (move_uploaded_file($tmp, '../uploads/gallery/' . $fname)) {
            $caption = trim($_POST['caption'] ?? '');
            $pdo->prepare("INSERT INTO gallery (image,caption,category,sort_order) VALUES (?,?,?,?)")
                ->execute(['uploads/gallery/'.$fname, $caption, $category, $sort_order + $i]);
            $uploaded++;
        }
    }
    $_SESSION['flash_success'] = "$uploaded photo(s) uploaded.";
    header('Location: gallery.php');
    exit;
}

/* ── Toggle active / delete ── */
if ($action === 'toggle' && $id) {
    verifyCsrf();
    $pdo->prepare("UPDATE gallery SET active = 1 - active WHERE id=?")->execute([$id]);
    header('Location: gallery.php');
    exit;
}
if ($action === 'delete' && $id) {
    verifyCsrf();
    $row = $pdo->prepare("SELECT image FROM gallery WHERE id=?");
    $row->execute([$id]);
    $img = $row->fetchColumn();
    if ($img && file_exists('../' . $img)) { unlink('../' . $img); }
    $pdo->prepare("DELETE FROM gallery WHERE id=?")->execute([$id]);
    $_SESSION['flash_success'] = 'Photo deleted.';
    header('Location: gallery.php');
    exit;
}

$admin_title = 'Gallery / Photos';
require_once 'includes/header.php';
?>

<div class="row g-4">
    <!-- Upload form -->
    <div class="col-lg-4">
        <div class="admin-card">
            <div class="admin-card-header"><h2>Upload Photos</h2></div>
            <div class="admin-card-body">
                <form method="post" action="gallery.php" enctype="multipart/form-data" class="admin-form">
                    <input type="hidden" name="csrf_token" value="<?php echo csrfToken(); ?>">
                    <div class="form-group">
                        <label>Select Photos (multiple allowed, max 5MB each)</label>
                        <input type="file" name="images[]" accept="image/jpeg,image/png,image/webp" multiple required
                               style="padding:10px;border:2px dashed #dde8ed;border-radius:8px;width:100%;">
                    </div>
                    <div class="form-group">
                        <label>Caption (optional)</label>
                        <input type="text" name="caption" placeholder="Short description">
                    </div>
                    <div class="form-group">
                        <label>Category</label>
                        <select name="category">
                            <option value="general">General</option>
                            <option value="hero">Hero / Banner</option>
                            <option value="about">About Section</option>
                            <option value="services">Services</option>
                            <option value="properties">Properties</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Sort Order</label>
                        <input type="number" name="sort_order" value="0" min="0">
                    </div>
                    <button type="submit" class="btn-save" style="width:100%;">
                        <i class="fas fa-cloud-upload-alt"></i> Upload
                    </button>
                </form>
            </div>
        </div>
    </div>

    <!-- Gallery grid -->
    <div class="col-lg-8">
        <div class="admin-card">
            <div class="admin-card-header"><h2>All Photos</h2></div>
            <div class="admin-card-body">
                <?php
                $photos = $pdo->query("SELECT * FROM gallery ORDER BY sort_order,id DESC")->fetchAll();
                if (empty($photos)): ?>
                <p style="color:#8fa4b0;text-align:center;padding:40px 0;">No photos yet. Upload some!</p>
                <?php else: ?>
                <div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(140px,1fr));gap:12px;">
                    <?php foreach ($photos as $p): ?>
                    <div style="position:relative;border-radius:10px;overflow:hidden;border:1px solid #f0f4f7;">
                        <img src="../<?php echo htmlspecialchars($p['image']); ?>"
                             style="width:100%;height:110px;object-fit:cover;display:block;opacity:<?php echo $p['active']?1:.4;?>;"
                             alt="<?php echo htmlspecialchars($p['caption']??''); ?>"
                             loading="lazy">
                        <div style="position:absolute;top:6px;right:6px;display:flex;gap:4px;">
                            <a href="?action=toggle&id=<?php echo $p['id']; ?>&csrf_token=<?php echo csrfToken(); ?>"
                               title="<?php echo $p['active']?'Hide':'Show'; ?>"
                               style="width:26px;height:26px;border-radius:50%;background:<?php echo $p['active']?'#27ae60':'#95a5a6';?>;display:flex;align-items:center;justify-content:center;">
                                <i class="fas fa-<?php echo $p['active']?'eye':'eye-slash'; ?>" style="color:#fff;font-size:11px;"></i>
                            </a>
                            <a href="?action=delete&id=<?php echo $p['id']; ?>&csrf_token=<?php echo csrfToken(); ?>"
                               data-confirm="Delete this photo permanently?"
                               style="width:26px;height:26px;border-radius:50%;background:#e74c3c;display:flex;align-items:center;justify-content:center;">
                                <i class="fas fa-times" style="color:#fff;font-size:11px;"></i>
                            </a>
                        </div>
                        <?php if ($p['caption']): ?>
                        <div style="padding:6px 8px;font-size:11px;color:#4a6a79;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;">
                            <?php echo htmlspecialchars($p['caption']); ?>
                        </div>
                        <?php endif; ?>
                        <div style="padding:0 8px 6px;font-size:10px;color:#8fa4b0;text-transform:uppercase;letter-spacing:1px;">
                            <?php echo htmlspecialchars($p['category']); ?>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<?php require_once 'includes/footer.php'; ?>
