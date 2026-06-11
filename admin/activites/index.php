<?php
$page_title = 'Gestion des activites';
require_once __DIR__ . '/../../includes/admin-header.php';
$items = Activity::all();
?>
<?php require_once __DIR__ . '/../../includes/admin-sidebar.php'; ?>
<main class="admin-main">
    <div class="admin-topbar"><h1>Activites</h1><a class="button" href="<?= e(admin_url('activites/create.php')); ?>">Ajouter</a></div>
    <?php if ($adminFlash): ?><div class="flash-banner flash flash-<?= e($adminFlash['type']); ?>"><?= e($adminFlash['message']); ?></div><?php endif; ?>
    <section class="table-card">
        <table>
            <thead><tr><th>Titre</th><th>Date</th><th>Lieu</th><th>Statut</th><th>Actions</th></tr></thead>
            <tbody>
            <?php foreach ($items as $item): ?>
                <tr>
                    <td><?= e($item['title']); ?></td>
                    <td><?= e(format_date($item['activity_date'])); ?></td>
                    <td><?= e($item['location']); ?></td>
                    <td><span class="status-pill <?= $item['is_published'] ? 'status-active' : 'status-inactive'; ?>"><?= $item['is_published'] ? 'Publiee' : 'Brouillon'; ?></span></td>
                    <td class="actions">
                        <a class="button button-secondary" href="<?= e(admin_url('activites/edit.php?id=' . $item['id'])); ?>">Modifier</a>
                        <form class="inline-form" method="post" action="<?= e(admin_url('activites/delete.php?id=' . $item['id'])); ?>" data-confirm="Supprimer cette activite ?">
                            <?= csrf_field(); ?>
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
