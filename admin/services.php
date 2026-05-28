<?php
require_once '../config/database.php';
require_once '../config/auth.php';
requireAdminLogin();

$pdo           = getDB();
$admin_section = 'services';
$action        = $_GET['action'] ?? 'list';
$id            = (int)($_GET['id'] ?? 0);

/* ── Handle POST ── */
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    verifyCsrf();
    $title       = trim($_POST['title']       ?? '');
    $description = trim($_POST['description'] ?? '');
    $icon        = trim($_POST['icon']        ?? 'far fa-star');
    $sort_order  = (int)($_POST['sort_order'] ?? 0);
    $active      = isset($_POST['active']) ? 1 : 0;

    /* Handle image upload */
    $image = $_POST['existing_image'] ?? null;
    if (!empty($_FILES['image']['tmp_name'])) {
        $ext     = strtolower(pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION));
        $allowed = ['jpg','jpeg','png','webp'];
        if (in_array($ext, $allowed, true) && $_FILES['image']['size'] < 3_000_000) {
            $filename = 'svc_' . uniqid() . '.' . $ext;
            $dest     = '../uploads/services/' . $filename;
            if (move_uploaded_file($_FILES['image']['tmp_name'], $dest)) {
                $image = 'uploads/services/' . $filename;
            }
        }
    }

    $post_id = (int)($_POST['id'] ?? 0);
    if ($post_id) {
        $pdo->prepare("UPDATE services SET title=?,description=?,icon=?,image=?,sort_order=?,active=? WHERE id=?")
            ->execute([$title,$description,$icon,$image,$sort_order,$active,$post_id]);
    } else {
        $pdo->prepare("INSERT INTO services (title,description,icon,image,sort_order,active) VALUES (?,?,?,?,?,?)")
            ->execute([$title,$description,$icon,$image,$sort_order,$active]);
    }
    $_SESSION['flash_success'] = $post_id ? 'Service updated.' : 'Service added.';
    header('Location: services.php');
    exit;
}

/* ── Handle delete ── */
if ($action === 'delete' && $id) {
    verifyCsrf();
    $pdo->prepare("DELETE FROM services WHERE id=?")->execute([$id]);
    $_SESSION['flash_success'] = 'Service deleted.';
    header('Location: services.php');
    exit;
}

/* ── Load edit row ── */
$row = null;
if ($action === 'edit' && $id) {
    $row = $pdo->prepare("SELECT * FROM services WHERE id=?");
    $row->execute([$id]);
    $row = $row->fetch();
}
$admin_title = $action === 'list' ? 'Services' : ($action === 'add' ? 'Add Service' : 'Edit Service');
require_once 'includes/header.php';
?>

<?php if ($action === 'list'): ?>
<div class="admin-card">
    <div class="admin-card-header">
        <h2>All Services</h2>
        <a href="?action=add" class="btn-sm-brand"><i class="fas fa-plus"></i> Add Service</a>
    </div>
    <div style="overflow-x:auto;">
        <table class="admin-table">
            <thead><tr><th>#</th><th>Icon</th><th>Title</th><th>Order</th><th>Status</th><th>Actions</th></tr></thead>
            <tbody>
            <?php $rows = $pdo->query("SELECT * FROM services ORDER BY sort_order,id")->fetchAll();
            foreach ($rows as $s): ?>
            <tr>
                <td><?php echo $s['id']; ?></td>
                <td><i class="<?php echo htmlspecialchars($s['icon']); ?>" style="font-size:20px;color:#8FA9B5;"></i></td>
                <td><strong><?php echo htmlspecialchars($s['title']); ?></strong></td>
                <td><?php echo $s['sort_order']; ?></td>
                <td><?php echo $s['active'] ? '<span class="badge-active">Active</span>' : '<span class="badge-inactive">Hidden</span>'; ?></td>
                <td style="display:flex;gap:8px;">
                    <a href="?action=edit&id=<?php echo $s['id']; ?>" class="btn-sm-brand"><i class="fas fa-edit"></i> Edit</a>
                    <a href="?action=delete&id=<?php echo $s['id']; ?>&csrf_token=<?php echo csrfToken(); ?>"
                       class="btn-sm-danger"
                       data-confirm="Delete '<?php echo htmlspecialchars($s['title']); ?>'?">
                        <i class="fas fa-trash"></i> Delete
                    </a>
                </td>
            </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<?php else: ?>
<div class="admin-card" style="max-width:700px;">
    <div class="admin-card-header">
        <h2><?php echo $action === 'add' ? 'Add Service' : 'Edit Service'; ?></h2>
        <a href="services.php" class="btn-sm-brand" style="background:#6c8795;"><i class="fas fa-arrow-left"></i> Back</a>
    </div>
    <div class="admin-card-body">
        <form method="post" action="services.php" enctype="multipart/form-data" class="admin-form">
            <?php if ($row): ?><input type="hidden" name="id" value="<?php echo $row['id']; ?>"><?php endif; ?>
            <input type="hidden" name="csrf_token" value="<?php echo csrfToken(); ?>">
            <input type="hidden" name="existing_image" value="<?php echo htmlspecialchars($row['image'] ?? ''); ?>">

            <div class="form-group">
                <label>Service Title *</label>
                <input type="text" name="title" value="<?php echo htmlspecialchars($row['title'] ?? ''); ?>" required placeholder="e.g. Full Buying Service">
            </div>
            <div class="form-group">
                <label>Description</label>
                <textarea name="description" rows="4" placeholder="Short description of this service"><?php echo htmlspecialchars($row['description'] ?? ''); ?></textarea>
            </div>
            <div class="row">
                <div class="col-md-6 form-group">
                    <label>Font Awesome Icon Class</label>
                    <input type="text" name="icon" value="<?php echo htmlspecialchars($row['icon'] ?? 'far fa-star'); ?>" placeholder="far fa-home">
                    <small style="color:#8fa4b0;font-size:12px;">Find icons at <a href="https://fontawesome.com/icons" target="_blank">fontawesome.com</a></small>
                </div>
                <div class="col-md-6 form-group">
                    <label>Sort Order</label>
                    <input type="number" name="sort_order" value="<?php echo (int)($row['sort_order'] ?? 0); ?>" min="0">
                </div>
            </div>
            <div class="form-group">
                <label>Service Image (optional, max 3MB — JPG/PNG/WebP)</label>
                <?php if (!empty($row['image'])): ?>
                <div style="margin-bottom:10px;">
                    <img src="../<?php echo htmlspecialchars($row['image']); ?>" class="img-preview" alt="Current image">
                    <small style="color:#8fa4b0;margin-left:8px;">Current image — upload a new one to replace</small>
                </div>
                <?php endif; ?>
                <input type="file" name="image" accept="image/jpeg,image/png,image/webp" style="padding:8px;border:1.5px dashed #dde8ed;border-radius:8px;width:100%;">
            </div>
            <div class="form-group">
                <label style="display:flex;align-items:center;gap:10px;cursor:pointer;">
                    <input type="checkbox" name="active" <?php echo ($row['active'] ?? 1) ? 'checked' : ''; ?> style="width:18px;height:18px;">
                    Show this service on the website
                </label>
            </div>
            <button type="submit" class="btn-save"><i class="fas fa-save"></i> Save Service</button>
        </form>
    </div>
</div>
<?php endif; ?>

<?php require_once 'includes/footer.php'; ?>
