<?php
require_once '../config/database.php';
require_once '../config/auth.php';
requireAdminLogin();

$pdo           = getDB();
$admin_section = 'listings';
$action        = $_GET['action'] ?? 'list';
$id            = (int)($_GET['id'] ?? 0);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    verifyCsrf();
    $fields = [
        'title'       => trim($_POST['title']       ?? ''),
        'address'     => trim($_POST['address']     ?? ''),
        'suburb'      => trim($_POST['suburb']      ?? ''),
        'price'       => trim($_POST['price']       ?? ''),
        'bedrooms'    => (int)($_POST['bedrooms']   ?? 0),
        'bathrooms'   => (int)($_POST['bathrooms']  ?? 0),
        'car_spaces'  => (int)($_POST['car_spaces'] ?? 0),
        'description' => trim($_POST['description'] ?? ''),
        'status'      => $_POST['status'] ?? 'available',
        'featured'    => isset($_POST['featured']) ? 1 : 0,
        'sort_order'  => (int)($_POST['sort_order'] ?? 0),
    ];

    $image = $_POST['existing_image'] ?? null;
    if (!empty($_FILES['image']['tmp_name'])) {
        $ext = strtolower(pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION));
        if (in_array($ext, ['jpg','jpeg','png','webp'], true) && $_FILES['image']['size'] < 5_000_000) {
            $fname = 'lst_' . uniqid() . '.' . $ext;
            if (move_uploaded_file($_FILES['image']['tmp_name'], '../uploads/listings/' . $fname)) {
                $image = 'uploads/listings/' . $fname;
            }
        }
    }
    $fields['image'] = $image;

    $post_id = (int)($_POST['id'] ?? 0);
    $cols    = implode(',', array_map(fn($k) => "$k=?", array_keys($fields)));
    if ($post_id) {
        $pdo->prepare("UPDATE listings SET $cols WHERE id=?")
            ->execute([...array_values($fields), $post_id]);
    } else {
        $keys = implode(',', array_keys($fields));
        $ph   = implode(',', array_fill(0, count($fields), '?'));
        $pdo->prepare("INSERT INTO listings ($keys) VALUES ($ph)")->execute(array_values($fields));
    }
    $_SESSION['flash_success'] = $post_id ? 'Listing updated.' : 'Listing added.';
    header('Location: listings.php');
    exit;
}

if ($action === 'delete' && $id) {
    verifyCsrf();
    $pdo->prepare("DELETE FROM listings WHERE id=?")->execute([$id]);
    $_SESSION['flash_success'] = 'Listing deleted.';
    header('Location: listings.php');
    exit;
}

$row = null;
if (($action === 'edit') && $id) {
    $s = $pdo->prepare("SELECT * FROM listings WHERE id=?");
    $s->execute([$id]);
    $row = $s->fetch();
}

if ($action === 'add')       { $admin_title = 'Add Listing'; }
elseif ($action === 'edit') { $admin_title = 'Edit Listing'; }
else                        { $admin_title = 'Listings'; }
require_once 'includes/header.php';
?>

<?php if ($action === 'list'): ?>
<div class="admin-card">
    <div class="admin-card-header">
        <h2>All Listings</h2>
        <a href="?action=add" class="btn-sm-brand"><i class="fas fa-plus"></i> Add Listing</a>
    </div>
    <div style="overflow-x:auto;">
        <table class="admin-table">
            <thead><tr><th>Photo</th><th>Title</th><th>Suburb</th><th>Price</th><th>Status</th><th>Featured</th><th>Actions</th></tr></thead>
            <tbody>
            <?php foreach ($pdo->query("SELECT * FROM listings ORDER BY sort_order,id DESC")->fetchAll() as $l): ?>
            <tr>
                <td><?php if ($l['image']): ?><img src="../<?php echo htmlspecialchars($l['image']); ?>" class="img-preview" alt=""><?php else: ?>—<?php endif; ?></td>
                <td><strong><?php echo htmlspecialchars($l['title']); ?></strong></td>
                <td><?php echo htmlspecialchars($l['suburb'] ?? '—'); ?></td>
                <td><?php echo htmlspecialchars($l['price'] ?? '—'); ?></td>
                <td><span class="badge-<?php echo $l['status'] === 'available' ? 'active' : 'inactive'; ?>"><?php echo ucwords(str_replace('_',' ',$l['status'])); ?></span></td>
                <td><?php echo $l['featured'] ? '<i class="fas fa-star" style="color:#f39c12;"></i>' : '—'; ?></td>
                <td style="display:flex;gap:8px;">
                    <a href="?action=edit&id=<?php echo $l['id']; ?>" class="btn-sm-brand"><i class="fas fa-edit"></i> Edit</a>
                    <a href="?action=delete&id=<?php echo $l['id']; ?>&csrf_token=<?php echo csrfToken(); ?>"
                       class="btn-sm-danger"
                       data-confirm="Delete '<?php echo htmlspecialchars($l['title']); ?>'?">
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
<div class="admin-card" style="max-width:800px;">
    <div class="admin-card-header">
        <h2><?php echo $action === 'add' ? 'Add Listing' : 'Edit Listing'; ?></h2>
        <a href="listings.php" class="btn-sm-brand" style="background:#6c8795;"><i class="fas fa-arrow-left"></i> Back</a>
    </div>
    <div class="admin-card-body">
        <form method="post" action="listings.php" enctype="multipart/form-data" class="admin-form">
            <?php if ($row): ?><input type="hidden" name="id" value="<?php echo $row['id']; ?>"><?php endif; ?>
            <input type="hidden" name="csrf_token" value="<?php echo csrfToken(); ?>">
            <input type="hidden" name="existing_image" value="<?php echo htmlspecialchars($row['image'] ?? ''); ?>">

            <div class="row">
                <div class="col-md-8 form-group">
                    <label for="lst_title">Property Title *</label>
                    <input id="lst_title" type="text" name="title" value="<?php echo htmlspecialchars($row['title'] ?? ''); ?>" required placeholder="e.g. Modern Family Home in Scarborough">
                </div>
                <div class="col-md-4 form-group">
                    <label for="lst_suburb">Suburb</label>
                    <input id="lst_suburb" type="text" name="suburb" value="<?php echo htmlspecialchars($row['suburb'] ?? ''); ?>" placeholder="e.g. Scarborough">
                </div>
            </div>
            <div class="form-group">
                <label for="lst_address">Address</label>
                <input id="lst_address" type="text" name="address" value="<?php echo htmlspecialchars($row['address'] ?? ''); ?>" placeholder="Street address (optional)">
            </div>
            <div class="row">
                <div class="col-md-3 form-group">
                    <label for="lst_price">Price</label>
                    <input id="lst_price" type="text" name="price" value="<?php echo htmlspecialchars($row['price'] ?? ''); ?>" placeholder="$850,000">
                </div>
                <div class="col-md-3 form-group">
                    <label for="lst_bedrooms">Bedrooms</label>
                    <input id="lst_bedrooms" type="number" name="bedrooms" value="<?php echo (int)($row['bedrooms'] ?? 0); ?>" min="0">
                </div>
                <div class="col-md-3 form-group">
                    <label for="lst_bathrooms">Bathrooms</label>
                    <input id="lst_bathrooms" type="number" name="bathrooms" value="<?php echo (int)($row['bathrooms'] ?? 0); ?>" min="0">
                </div>
                <div class="col-md-3 form-group">
                    <label for="lst_car">Car Spaces</label>
                    <input id="lst_car" type="number" name="car_spaces" value="<?php echo (int)($row['car_spaces'] ?? 0); ?>" min="0">
                </div>
            </div>
            <div class="form-group">
                <label for="lst_desc">Description</label>
                <textarea id="lst_desc" name="description" rows="4" placeholder="Property details..."><?php echo htmlspecialchars($row['description'] ?? ''); ?></textarea>
            </div>
            <div class="row">
                <div class="col-md-4 form-group">
                    <label for="lst_status">Status</label>
                    <select id="lst_status" name="status">
                        <?php foreach (array('available'=>'Available','sold'=>'Sold','under_offer'=>'Under Offer') as $v=>$l): ?>
                        <option value="<?php echo $v; ?>" <?php echo ($row['status'] ?? 'available')===$v?'selected':''; ?>><?php echo $l; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-md-4 form-group">
                    <label for="lst_order">Sort Order</label>
                    <input id="lst_order" type="number" name="sort_order" value="<?php echo (int)($row['sort_order'] ?? 0); ?>" min="0">
                </div>
                <div class="col-md-4 form-group" style="display:flex;align-items:flex-end;padding-bottom:20px;">
                    <label for="lst_featured" style="display:flex;align-items:center;gap:10px;cursor:pointer;">
                        <input id="lst_featured" type="checkbox" name="featured" <?php echo ($row['featured'] ?? 0)?'checked':''; ?> style="width:18px;height:18px;">
                        Feature on homepage
                    </label>
                </div>
            </div>
            <div class="form-group">
                <label for="lst_image">Property Photo (max 5MB — JPG/PNG/WebP)</label>
                <?php if (!empty($row['image'])): ?>
                <div style="margin-bottom:10px;">
                    <img src="../<?php echo htmlspecialchars($row['image']); ?>" class="img-preview" alt="Current uploaded file">
                </div>
                <?php endif; ?>
                <input id="lst_image" type="file" name="image" accept="image/jpeg,image/png,image/webp" style="padding:8px;border:1.5px dashed #dde8ed;border-radius:8px;width:100%;">
            </div>
            <button type="submit" class="btn-save"><i class="fas fa-save"></i> Save Listing</button>
        </form>
    </div>
</div>
<?php endif; ?>

<?php require_once 'includes/footer.php'; ?>
