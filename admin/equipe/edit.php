<?php
$page_title = 'Modifier un membre';
require_once __DIR__ . '/../../includes/admin-header.php';
$id = (int) ($_GET['id'] ?? 0);
$item = TeamMember::find($id);

if (!$item) {
    set_flash('error', 'Membre introuvable.');
    redirect(admin_url('equipe/index.php'));
}

if (($_SERVER['REQUEST_METHOD'] ?? 'GET') === 'POST') {
    verify_csrf();
    $photo = $item['photo'];
    try {
        $uploaded = upload_image('photo', 'equipe');
        if ($uploaded) {
            $photo = $uploaded;
        }
    } catch (RuntimeException $exception) {
        if (!empty($_FILES['photo']['name'])) {
            set_flash('error', $exception->getMessage());
            redirect(admin_url('equipe/edit.php?id=' . $id));
        }
    }

    TeamMember::update($id, [
        'name' => post_string('name', 150),
        'job_title' => post_string('job_title', 150),
        'phone_extension' => post_string('phone_extension', 50),
        'email' => post_email('email'),
        'photo' => $photo,
        'bio' => post_text('bio'),
        'display_order' => post_int('display_order'),
        'is_active' => post_bool('is_active'),
    ]);
    set_flash('success', 'Membre modifie.');
    redirect(admin_url('equipe/index.php'));
}
?>
<?php require_once __DIR__ . '/../../includes/admin-sidebar.php'; ?>
<main class="admin-main">
    <div class="admin-topbar"><h1>Modifier un membre</h1></div>
    <section class="form-card">
        <form class="admin-form" method="post" enctype="multipart/form-data">
            <?= csrf_field(); ?>
            <label>Nom<input type="text" name="name" value="<?= e($item['name']); ?>" required></label>
            <label>Poste<input type="text" name="job_title" value="<?= e($item['job_title']); ?>" required></label>
            <label>Extension telephonique<input type="text" name="phone_extension" value="<?= e($item['phone_extension']); ?>"></label>
            <label>Courriel<input type="email" name="email" value="<?= e($item['email']); ?>"></label>
            <label>Photo<input type="file" name="photo" accept=".jpg,.jpeg,.png,.webp"></label>
            <label>Bio<textarea name="bio"><?= e($item['bio']); ?></textarea></label>
            <label>Ordre d'affichage<input type="number" name="display_order" value="<?= (int) $item['display_order']; ?>"></label>
            <label><input type="checkbox" name="is_active"<?= $item['is_active'] ? ' checked' : ''; ?>> Actif</label>
            <button type="submit">Mettre a jour</button>
        </form>
    </section>
</main>
<?php require_once __DIR__ . '/../../includes/admin-footer.php'; ?>
