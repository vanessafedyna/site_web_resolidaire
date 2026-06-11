<?php
$page_title = 'Modifier un service';
require_once __DIR__ . '/../../includes/admin-header.php';
$id = (int) ($_GET['id'] ?? 0);
$item = Service::find($id);

if (!$item) {
    set_flash('error', 'Service introuvable.');
    redirect(admin_url('services/index.php'));
}

if (($_SERVER['REQUEST_METHOD'] ?? 'GET') === 'POST') {
    verify_csrf();
    $image = $item['image'];
    try {
        $uploaded = upload_image('image', 'services');
        if ($uploaded) {
            $image = $uploaded;
        }
    } catch (RuntimeException $exception) {
        if (!empty($_FILES['image']['name'])) {
            set_flash('error', $exception->getMessage());
            redirect(admin_url('services/edit.php?id=' . $id));
        }
    }

    Service::update($id, [
        'title' => post_string('title', 180),
        'slug' => post_string('slug', 180),
        'short_description' => post_text('short_description'),
        'full_description' => post_text('full_description'),
        'eligibility' => post_text('eligibility'),
        'price_info' => post_text('price_info'),
        'contact_info' => post_text('contact_info'),
        'image' => $image,
        'display_order' => post_int('display_order'),
        'is_active' => post_bool('is_active'),
    ]);
    set_flash('success', 'Service modifie.');
    redirect(admin_url('services/index.php'));
}
?>
<?php require_once __DIR__ . '/../../includes/admin-sidebar.php'; ?>
<main class="admin-main">
    <div class="admin-topbar"><h1>Modifier un service</h1></div>
    <section class="form-card">
        <form class="admin-form" method="post" enctype="multipart/form-data">
            <?= csrf_field(); ?>
            <label>Titre<input type="text" name="title" value="<?= e($item['title']); ?>" required></label>
            <label>Slug<input type="text" name="slug" value="<?= e($item['slug']); ?>" required></label>
            <label>Description courte<textarea name="short_description"><?= e($item['short_description']); ?></textarea></label>
            <label>Description complete<textarea name="full_description"><?= e($item['full_description']); ?></textarea></label>
            <label>Admissibilite<textarea name="eligibility"><?= e($item['eligibility']); ?></textarea></label>
            <label>Cout<textarea name="price_info"><?= e($item['price_info']); ?></textarea></label>
            <label>Contact<textarea name="contact_info"><?= e($item['contact_info']); ?></textarea></label>
            <label>Image<input type="file" name="image" accept=".jpg,.jpeg,.png,.webp"></label>
            <label>Ordre<input type="number" name="display_order" value="<?= (int) $item['display_order']; ?>"></label>
            <label><input type="checkbox" name="is_active"<?= $item['is_active'] ? ' checked' : ''; ?>> Actif</label>
            <button type="submit">Mettre a jour</button>
        </form>
    </section>
</main>
<?php require_once __DIR__ . '/../../includes/admin-footer.php'; ?>
