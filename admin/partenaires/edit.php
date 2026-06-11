<?php
$page_title = 'Modifier un partenaire';
require_once __DIR__ . '/../../includes/admin-header.php';
$id = (int) ($_GET['id'] ?? 0);
$item = Partner::find($id);

if (!$item) {
    set_flash('error', 'Partenaire introuvable.');
    redirect(admin_url('partenaires/index.php'));
}

if (($_SERVER['REQUEST_METHOD'] ?? 'GET') === 'POST') {
    verify_csrf();
    $logo = $item['logo'];
    try {
        $uploaded = upload_image('logo', 'partenaires');
        if ($uploaded) {
            $logo = $uploaded;
        }
    } catch (RuntimeException $exception) {
        if (!empty($_FILES['logo']['name'])) {
            set_flash('error', $exception->getMessage());
            redirect(admin_url('partenaires/edit.php?id=' . $id));
        }
    }

    Partner::update($id, [
        'name' => post_string('name', 180),
        'description' => post_text('description'),
        'logo' => $logo,
        'website_url' => post_url('website_url'),
        'display_order' => post_int('display_order'),
        'is_active' => post_bool('is_active'),
    ]);
    set_flash('success', 'Partenaire modifie.');
    redirect(admin_url('partenaires/index.php'));
}
?>
<?php require_once __DIR__ . '/../../includes/admin-sidebar.php'; ?>
<main class="admin-main">
    <div class="admin-topbar"><h1>Modifier un partenaire</h1></div>
    <section class="form-card">
        <form class="admin-form" method="post" enctype="multipart/form-data">
            <?= csrf_field(); ?>
            <label>Nom<input type="text" name="name" value="<?= e($item['name']); ?>" required></label>
            <label>Description<textarea name="description"><?= e($item['description']); ?></textarea></label>
            <label>Logo<input type="file" name="logo" accept=".jpg,.jpeg,.png,.webp"></label>
            <label>Lien du site web<input type="url" name="website_url" value="<?= e($item['website_url']); ?>"></label>
            <label>Ordre d'affichage<input type="number" name="display_order" value="<?= (int) $item['display_order']; ?>"></label>
            <label><input type="checkbox" name="is_active"<?= $item['is_active'] ? ' checked' : ''; ?>> Actif</label>
            <button type="submit">Mettre a jour</button>
        </form>
    </section>
</main>
<?php require_once __DIR__ . '/../../includes/admin-footer.php'; ?>
