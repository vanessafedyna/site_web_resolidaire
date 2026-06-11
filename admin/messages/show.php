<?php
$page_title = 'Voir un message';
require_once __DIR__ . '/../../includes/admin-header.php';
$id = (int) ($_GET['id'] ?? 0);
$item = Message::find($id);

if (!$item) {
    set_flash('error', 'Message introuvable.');
    redirect(admin_url('messages/index.php'));
}

Message::markAsRead($id);
?>
<?php require_once __DIR__ . '/../../includes/admin-sidebar.php'; ?>
<main class="admin-main">
    <div class="admin-topbar"><h1>Message de <?= e($item['name']); ?></h1></div>
    <section class="form-card">
        <p><strong>Courriel :</strong> <?= e($item['email']); ?></p>
        <p><strong>Telephone :</strong> <?= e($item['phone']); ?></p>
        <p><strong>Sujet :</strong> <?= e($item['subject']); ?></p>
        <p><strong>Date :</strong> <?= e(format_date($item['created_at'], 'd/m/Y H:i')); ?></p>
        <p><strong>Message :</strong></p>
        <p><?= nl2br(e($item['message'])); ?></p>
    </section>
</main>
<?php require_once __DIR__ . '/../../includes/admin-footer.php'; ?>
