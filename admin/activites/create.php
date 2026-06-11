<?php
$page_title = 'Ajouter une activite';
require_once __DIR__ . '/../../includes/admin-header.php';

if (($_SERVER['REQUEST_METHOD'] ?? 'GET') === 'POST') {
    verify_csrf();
    $image = null;
    try {
        $image = upload_image('image', 'activites');
    } catch (RuntimeException $exception) {
        set_flash('error', $exception->getMessage());
        redirect(admin_url('activites/create.php'));
    }

    Activity::create([
        'title' => post_string('title', 180),
        'description' => post_text('description'),
        'activity_date' => post_string('activity_date', 20),
        'start_time' => post_string('start_time', 20),
        'end_time' => post_string('end_time', 20),
        'location' => post_string('location', 180),
        'price' => post_string('price', 100),
        'image' => $image,
        'is_published' => post_bool('is_published'),
    ]);
    set_flash('success', 'Activite ajoutee.');
    redirect(admin_url('activites/index.php'));
}
?>
<?php require_once __DIR__ . '/../../includes/admin-sidebar.php'; ?>
<main class="admin-main">
    <div class="admin-topbar"><h1>Ajouter une activite</h1></div>
    <section class="form-card">
        <form class="admin-form" method="post" enctype="multipart/form-data">
            <?= csrf_field(); ?>
            <label>Titre<input type="text" name="title" required></label>
            <label>Description<textarea name="description"></textarea></label>
            <label>Date<input type="date" name="activity_date"></label>
            <label>Heure de debut<input type="time" name="start_time"></label>
            <label>Heure de fin<input type="time" name="end_time"></label>
            <label>Lieu<input type="text" name="location"></label>
            <label>Prix<input type="text" name="price"></label>
            <label>Image<input type="file" name="image" accept=".jpg,.jpeg,.png,.webp"></label>
            <label><input type="checkbox" name="is_published" checked> Publier</label>
            <button type="submit">Enregistrer</button>
        </form>
    </section>
</main>
<?php require_once __DIR__ . '/../../includes/admin-footer.php'; ?>
