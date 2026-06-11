<?php
$page_title = 'Modifier une activite';
require_once __DIR__ . '/../../includes/admin-header.php';
$id = (int) ($_GET['id'] ?? 0);
$item = Activity::find($id);

if (!$item) {
    set_flash('error', 'Activite introuvable.');
    redirect(admin_url('activites/index.php'));
}

if (($_SERVER['REQUEST_METHOD'] ?? 'GET') === 'POST') {
    verify_csrf();
    $image = $item['image'];
    try {
        $uploaded = upload_image('image', 'activites');
        if ($uploaded) {
            $image = $uploaded;
        }
    } catch (RuntimeException $exception) {
        if (!empty($_FILES['image']['name'])) {
            set_flash('error', $exception->getMessage());
            redirect(admin_url('activites/edit.php?id=' . $id));
        }
    }

    Activity::update($id, [
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
    set_flash('success', 'Activite modifiee.');
    redirect(admin_url('activites/index.php'));
}
?>
<?php require_once __DIR__ . '/../../includes/admin-sidebar.php'; ?>
<main class="admin-main">
    <div class="admin-topbar"><h1>Modifier une activite</h1></div>
    <section class="form-card">
        <form class="admin-form" method="post" enctype="multipart/form-data">
            <?= csrf_field(); ?>
            <label>Titre<input type="text" name="title" value="<?= e($item['title']); ?>" required></label>
            <label>Description<textarea name="description"><?= e($item['description']); ?></textarea></label>
            <label>Date<input type="date" name="activity_date" value="<?= e($item['activity_date']); ?>"></label>
            <label>Heure de debut<input type="time" name="start_time" value="<?= e($item['start_time']); ?>"></label>
            <label>Heure de fin<input type="time" name="end_time" value="<?= e($item['end_time']); ?>"></label>
            <label>Lieu<input type="text" name="location" value="<?= e($item['location']); ?>"></label>
            <label>Prix<input type="text" name="price" value="<?= e($item['price']); ?>"></label>
            <label>Image<input type="file" name="image" accept=".jpg,.jpeg,.png,.webp"></label>
            <label><input type="checkbox" name="is_published"<?= $item['is_published'] ? ' checked' : ''; ?>> Publier</label>
            <button type="submit">Mettre a jour</button>
        </form>
    </section>
</main>
<?php require_once __DIR__ . '/../../includes/admin-footer.php'; ?>
