<?php
require_once '../config/database.php';
require_once '../config/auth.php';
requireAdminLogin();

$pdo           = getDB();
$admin_section = 'testimonials';
$action        = $_GET['action'] ?? 'list';
$id            = (int)($_GET['id'] ?? 0);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    verifyCsrf();
    $name       = trim($_POST['name']   ?? '');
    $role       = trim($_POST['role']   ?? '');
    $text       = trim($_POST['text']   ?? '');
    $rating     = min(5, max(1, (int)($_POST['rating'] ?? 5)));
    $sort_order = (int)($_POST['sort_order'] ?? 0);
    $active     = isset($_POST['active']) ? 1 : 0;

    $photo = $_POST['existing_photo'] ?? null;
    if (!empty($_FILES['photo']['tmp_name'])) {
        $ext = strtolower(pathinfo($_FILES['photo']['name'], PATHINFO_EXTENSION));
        if (in_array($ext, ['jpg','jpeg','png','webp'], true) && $_FILES['photo']['size'] < 2_000_000) {
            $fname = 'tst_' . uniqid() . '.' . $ext;
            if (move_uploaded_file($_FILES['photo']['tmp_name'], '../uploads/testimonials/' . $fname)) {
                $photo = 'uploads/testimonials/' . $fname;
            }
        }
    }

    $post_id = (int)($_POST['id'] ?? 0);
    if ($post_id) {
        $pdo->prepare("UPDATE testimonials SET name=?,role=?,text=?,photo=?,rating=?,sort_order=?,active=? WHERE id=?")
            ->execute([$name,$role,$text,$photo,$rating,$sort_order,$active,$post_id]);
    } else {
        $pdo->prepare("INSERT INTO testimonials (name,role,text,photo,rating,sort_order,active) VALUES (?,?,?,?,?,?,?)")
            ->execute([$name,$role,$text,$photo,$rating,$sort_order,$active]);
    }
    $_SESSION['flash_success'] = $post_id ? 'Testimonial updated.' : 'Testimonial added.';
    header('Location: testimonials.php');
    exit;
}

if ($action === 'delete' && $id) {
    verifyCsrf();
    $pdo->prepare("DELETE FROM testimonials WHERE id=?")->execute([$id]);
    $_SESSION['flash_success'] = 'Testimonial deleted.';
    header('Location: testimonials.php');
    exit;
}

$row = null;
if ($action === 'edit' && $id) {
    $s = $pdo->prepare("SELECT * FROM testimonials WHERE id=?");
    $s->execute([$id]);
    $row = $s->fetch();
}

$admin_title = match($action) {'add'=>'Add Testimonial','edit'=>'Edit Testimonial',default=>'Testimonials'};
require_once 'includes/header.php';
?>

<?php if ($action === 'list'): ?>
<div class="admin-card">
    <div class="admin-card-header">
        <h2>All Testimonials</h2>
        <a href="?action=add" class="btn-sm-brand"><i class="fas fa-plus"></i> Add Testimonial</a>
    </div>
    <div style="overflow-x:auto;">
        <table class="admin-table">
            <thead><tr><th>Photo</th><th>Name</th><th>Role</th><th>Rating</th><th>Status</th><th>Actions</th></tr></thead>
            <tbody>
            <?php foreach ($pdo->query("SELECT * FROM testimonials ORDER BY sort_order,id")->fetchAll() as $t): ?>
            <tr>
                <td>
                    <?php if ($t['photo']): ?>
                    <img src="../<?php echo htmlspecialchars($t['photo']); ?>" class="img-preview" style="border-radius:50%;width:45px;height:45px;" alt="">
                    <?php else: ?>
                    <div style="width:45px;height:45px;border-radius:50%;background:#8FA9B5;display:flex;align-items:center;justify-content:center;color:#fff;font-weight:700;">
                        <?php echo strtoupper(substr($t['name'],0,1)); ?>
                    </div>
                    <?php endif; ?>
                </td>
                <td><strong><?php echo htmlspecialchars($t['name']); ?></strong></td>
                <td><?php echo htmlspecialchars($t['role'] ?? '—'); ?></td>
                <td><?php echo str_repeat('★', (int)$t['rating']); ?></td>
                <td><?php echo $t['active'] ? '<span class="badge-active">Active</span>' : '<span class="badge-inactive">Hidden</span>'; ?></td>
                <td style="display:flex;gap:8px;">
                    <a href="?action=edit&id=<?php echo $t['id']; ?>" class="btn-sm-brand"><i class="fas fa-edit"></i> Edit</a>
                    <a href="?action=delete&id=<?php echo $t['id']; ?>&csrf_token=<?php echo csrfToken(); ?>"
                       class="btn-sm-danger"
                       data-confirm="Delete testimonial from <?php echo htmlspecialchars($t['name']); ?>?">
                        <i class="fas fa-trash"></i>
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
        <h2><?php echo $action === 'add' ? 'Add Testimonial' : 'Edit Testimonial'; ?></h2>
        <a href="testimonials.php" class="btn-sm-brand" style="background:#6c8795;"><i class="fas fa-arrow-left"></i> Back</a>
    </div>
    <div class="admin-card-body">
        <form method="post" action="testimonials.php" enctype="multipart/form-data" class="admin-form">
            <?php if ($row): ?><input type="hidden" name="id" value="<?php echo $row['id']; ?>"><?php endif; ?>
            <input type="hidden" name="csrf_token" value="<?php echo csrfToken(); ?>">
            <input type="hidden" name="existing_photo" value="<?php echo htmlspecialchars($row['photo'] ?? ''); ?>">

            <div class="row">
                <div class="col-md-6 form-group">
                    <label>Client Name *</label>
                    <input type="text" name="name" value="<?php echo htmlspecialchars($row['name'] ?? ''); ?>" required placeholder="Sarah & James Wilson">
                </div>
                <div class="col-md-6 form-group">
                    <label>Role / Location</label>
                    <input type="text" name="role" value="<?php echo htmlspecialchars($row['role'] ?? ''); ?>" placeholder="First Home Buyers, Scarborough">
                </div>
            </div>
            <div class="form-group">
                <label>Testimonial Text *</label>
                <textarea name="text" rows="5" required placeholder="What the client said..."><?php echo htmlspecialchars($row['text'] ?? ''); ?></textarea>
            </div>
            <div class="row">
                <div class="col-md-4 form-group">
                    <label>Star Rating</label>
                    <select name="rating">
                        <?php for ($i=5; $i>=1; $i--): ?>
                        <option value="<?php echo $i; ?>" <?php echo ($row['rating']??5)==$i?'selected':''; ?>><?php echo str_repeat('★',$i); ?></option>
                        <?php endfor; ?>
                    </select>
                </div>
                <div class="col-md-4 form-group">
                    <label>Sort Order</label>
                    <input type="number" name="sort_order" value="<?php echo (int)($row['sort_order']??0); ?>" min="0">
                </div>
            </div>
            <div class="form-group">
                <label>Client Photo (optional, max 2MB)</label>
                <?php if (!empty($row['photo'])): ?>
                <div style="margin-bottom:10px;">
                    <img src="../<?php echo htmlspecialchars($row['photo']); ?>" style="width:60px;height:60px;border-radius:50%;object-fit:cover;" alt="">
                </div>
                <?php endif; ?>
                <input type="file" name="photo" accept="image/jpeg,image/png,image/webp" style="padding:8px;border:1.5px dashed #dde8ed;border-radius:8px;width:100%;">
            </div>
            <div class="form-group">
                <label style="display:flex;align-items:center;gap:10px;cursor:pointer;">
                    <input type="checkbox" name="active" <?php echo ($row['active']??1)?'checked':''; ?> style="width:18px;height:18px;">
                    Show on website
                </label>
            </div>
            <button type="submit" class="btn-save"><i class="fas fa-save"></i> Save Testimonial</button>
        </form>
    </div>
</div>
<?php endif; ?>

<?php require_once 'includes/footer.php'; ?>
