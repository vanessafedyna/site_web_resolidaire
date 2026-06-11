<?php
$page_title = 'Ajouter un partenaire';
require_once __DIR__ . '/../../includes/admin-header.php';

if (($_SERVER['REQUEST_METHOD'] ?? 'GET') === 'POST') {
    verify_csrf();
    $logo = null;
    try {
        $logo = upload_image('logo', 'partenaires');
    } catch (RuntimeException $exception) {
        set_flash('error', $exception->getMessage());
        redirect(admin_url('partenaires/create.php'));
    }

    Partner::create([
        'name' => post_string('name', 180),
        'description' => post_text('description'),
        'logo' => $logo,
        'website_url' => post_url('website_url'),
        'display_order' => post_int('display_order'),
        'is_active' => post_bool('is_active'),
    ]);
    set_flash('success', 'Partenaire ajoute.');
    redirect(admin_url('partenaires/index.php'));
}
?>
<?php require_once __DIR__ . '/../../includes/admin-sidebar.php'; ?>
<main class="admin-main">
    <div class="admin-topbar"><h1>Ajouter un partenaire</h1></div>
    <section class="form-card">
        <form class="admin-form" method="post" enctype="multipart/form-data">
            <?= csrf_field(); ?>
            <label>Nom<input type="text" name="name" required></label>
            <label>Description<textarea name="description"></textarea></label>
            <label>Logo<input type="file" name="logo" accept=".jpg,.jpeg,.png,.webp"></label>
            <label>Lien du site web<input type="url" name="website_url"></label>
            <label>Ordre d'affichage<input type="number" name="display_order" value="0"></label>
            <label><input type="checkbox" name="is_active" checked> Actif</label>
            <button type="submit">Enregistrer</button>
        </form>
    </section>
</main>
<?php require_once __DIR__ . '/../../includes/admin-footer.php'; ?>
