<?php
$page_title = 'Ajouter un membre';
require_once __DIR__ . '/../../includes/admin-header.php';

if (($_SERVER['REQUEST_METHOD'] ?? 'GET') === 'POST') {
    verify_csrf();
    $photo = null;
    try {
        $photo = upload_image('photo', 'equipe');
    } catch (RuntimeException $exception) {
        set_flash('error', $exception->getMessage());
        redirect(admin_url('equipe/create.php'));
    }

    TeamMember::create([
        'name' => post_string('name', 150),
        'job_title' => post_string('job_title', 150),
        'phone_extension' => post_string('phone_extension', 50),
        'email' => post_email('email'),
        'photo' => $photo,
        'bio' => post_text('bio'),
        'display_order' => post_int('display_order'),
        'is_active' => post_bool('is_active'),
    ]);
    set_flash('success', 'Membre ajoute.');
    redirect(admin_url('equipe/index.php'));
}
?>
<?php require_once __DIR__ . '/../../includes/admin-sidebar.php'; ?>
<main class="admin-main">
    <div class="admin-topbar"><h1>Ajouter un membre</h1></div>
    <section class="form-card">
        <form class="admin-form" method="post" enctype="multipart/form-data">
            <?= csrf_field(); ?>
            <label>Nom<input type="text" name="name" required></label>
            <label>Poste<input type="text" name="job_title" required></label>
            <label>Extension telephonique<input type="text" name="phone_extension"></label>
            <label>Courriel<input type="email" name="email"></label>
            <label>Photo<input type="file" name="photo" accept=".jpg,.jpeg,.png,.webp"></label>
            <label>Bio<textarea name="bio"></textarea></label>
            <label>Ordre d'affichage<input type="number" name="display_order" value="0"></label>
            <label><input type="checkbox" name="is_active" checked> Actif</label>
            <button type="submit">Enregistrer</button>
        </form>
    </section>
</main>
<?php require_once __DIR__ . '/../../includes/admin-footer.php'; ?>
