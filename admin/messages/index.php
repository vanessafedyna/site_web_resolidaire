<?php
$page_title = 'Messages';
require_once __DIR__ . '/../../includes/admin-header.php';

if (($_SERVER['REQUEST_METHOD'] ?? 'GET') === 'POST') {
    verify_csrf();
    if (isset($_POST['delete_id'])) {
        Message::delete((int) $_POST['delete_id']);
        set_flash('success', 'Message supprime.');
        redirect(admin_url('messages/index.php'));
    }
}

$items = Message::all();
?>
<?php require_once __DIR__ . '/../../includes/admin-sidebar.php'; ?>
<main class="admin-main">
    <div class="admin-topbar"><h1>Messages recus</h1></div>
    <?php if ($adminFlash): ?><div class="flash-banner flash flash-<?= e($adminFlash['type']); ?>"><?= e($adminFlash['message']); ?></div><?php endif; ?>
    <section class="table-card">
        <table>
            <thead><tr><th>Nom</th><th>Sujet</th><th>Date</th><th>Statut</th><th>Actions</th></tr></thead>
            <tbody>
            <?php foreach ($items as $item): ?>
                <tr>
                    <td><?= e($item['name']); ?></td>
                    <td><?= e($item['subject']); ?></td>
                    <td><?= e(format_date($item['created_at'], 'd/m/Y H:i')); ?></td>
                    <td><span class="status-pill <?= $item['is_read'] ? 'status-active' : 'status-inactive'; ?>"><?= $item['is_read'] ? 'Lu' : 'Nouveau'; ?></span></td>
                    <td class="actions">
                        <a class="button button-secondary" href="<?= e(admin_url('messages/show.php?id=' . $item['id'])); ?>">Voir</a>
                        <form class="inline-form" method="post" action="" data-confirm="Supprimer ce message ?">
                            <?= csrf_field(); ?>
                            <input type="hidden" name="delete_id" value="<?= (int) $item['id']; ?>">
                            <button class="button-danger" type="submit">Supprimer</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </section>
</main>
<?php require_once __DIR__ . '/../../includes/admin-footer.php'; ?>
