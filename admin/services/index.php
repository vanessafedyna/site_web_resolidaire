<?php
$page_title = 'Gestion des services';
require_once __DIR__ . '/../../includes/admin-header.php';
$items = Service::all();
?>
<?php require_once __DIR__ . '/../../includes/admin-sidebar.php'; ?>
<main class="admin-main">
    <div class="admin-topbar"><h1>Services</h1></div>
    <?php if ($adminFlash): ?><div class="flash-banner flash flash-<?= e($adminFlash['type']); ?>"><?= e($adminFlash['message']); ?></div><?php endif; ?>
    <section class="table-card">
        <table>
            <thead><tr><th>Titre</th><th>Slug</th><th>Ordre</th><th>Statut</th><th>Actions</th></tr></thead>
            <tbody>
            <?php foreach ($items as $item): ?>
                <tr>
                    <td><?= e($item['title']); ?></td>
                    <td><?= e($item['slug']); ?></td>
                    <td><?= (int) $item['display_order']; ?></td>
                    <td><span class="status-pill <?= $item['is_active'] ? 'status-active' : 'status-inactive'; ?>"><?= $item['is_active'] ? 'Actif' : 'Inactif'; ?></span></td>
                    <td><a class="button button-secondary" href="<?= e(admin_url('services/edit.php?id=' . $item['id'])); ?>">Modifier</a></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </section>
</main>
<?php require_once __DIR__ . '/../../includes/admin-footer.php'; ?>
