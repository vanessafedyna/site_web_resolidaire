<?php
$page_title = 'Modifier un appel aux dons';
require_once __DIR__ . '/../../includes/admin-header.php';
$id = (int) ($_GET['id'] ?? 0);
$item = DonationCall::find($id);

if (!$item) {
    set_flash('error', 'Appel aux dons introuvable.');
    redirect(admin_url('dons/index.php'));
}

if (($_SERVER['REQUEST_METHOD'] ?? 'GET') === 'POST') {
    verify_csrf();
    $image = $item['image'];
    try {
        $uploaded = upload_image('image', 'dons');
        if ($uploaded) {
            $image = $uploaded;
        }
    } catch (RuntimeException $exception) {
        if (!empty($_FILES['image']['name'])) {
            set_flash('error', $exception->getMessage());
            redirect(admin_url('dons/edit.php?id=' . $id));
        }
    }

    DonationCall::update($id, [
        'title' => post_string('title', 180),
        'description' => post_text('description'),
        'button_text' => post_string('button_text', 100),
        'button_url' => post_url('button_url'),
        'image' => $image,
        'is_active' => post_bool('is_active'),
    ]);
    set_flash('success', 'Appel aux dons modifie.');
    redirect(admin_url('dons/index.php'));
}
?>
<?php require_once __DIR__ . '/../../includes/admin-sidebar.php'; ?>
<main class="admin-main">
    <div class="admin-topbar"><h1>Modifier un appel aux dons</h1></div>
    <section class="form-card">
        <form class="admin-form" method="post" enctype="multipart/form-data">
            <?= csrf_field(); ?>
            <label>Titre<input type="text" name="title" value="<?= e($item['title']); ?>" required></label>
            <label>Description<textarea name="description"><?= e($item['description']); ?></textarea></label>
            <label>Texte du bouton<input type="text" name="button_text" value="<?= e($item['button_text']); ?>"></label>
            <label>Lien du bouton<input type="url" name="button_url" value="<?= e($item['button_url']); ?>"></label>
            <label>Image<input type="file" name="image" accept=".jpg,.jpeg,.png,.webp"></label>
            <label><input type="checkbox" name="is_active"<?= $item['is_active'] ? ' checked' : ''; ?>> Actif</label>
            <button type="submit">Mettre a jour</button>
        </form>
    </section>
</main>
<?php require_once __DIR__ . '/../../includes/admin-footer.php'; ?>
