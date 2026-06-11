<?php
$page_title = 'Gestion de l\'equipe';
require_once __DIR__ . '/../../includes/admin-header.php';
$items = TeamMember::all();
?>
<?php require_once __DIR__ . '/../../includes/admin-sidebar.php'; ?>
<main class="admin-main">
    <div class="admin-topbar">
        <h1>Equipe</h1>
        <a class="button" href="<?= e(admin_url('equipe/create.php')); ?>">Ajouter</a>
    </div>
    <?php if ($adminFlash): ?><div class="flash-banner flash flash-<?= e($adminFlash['type']); ?>"><?= e($adminFlash['message']); ?></div><?php endif; ?>
    <section class="table-card">
        <table>
            <thead><tr><th>Nom</th><th>Poste</th><th>Ordre</th><th>Statut</th><th>Actions</th></tr></thead>
            <tbody>
            <?php foreach ($items as $item): ?>
                <tr>
                    <td><?= e($item['name']); ?></td>
                    <td><?= e($item['job_title']); ?></td>
                    <td><?= (int) $item['display_order']; ?></td>
                    <td><span class="status-pill <?= $item['is_active'] ? 'status-active' : 'status-inactive'; ?>"><?= $item['is_active'] ? 'Actif' : 'Inactif'; ?></span></td>
                    <td class="actions">
                        <a class="button button-secondary" href="<?= e(admin_url('equipe/edit.php?id=' . $item['id'])); ?>">Modifier</a>
                        <form class="inline-form" method="post" action="<?= e(admin_url('equipe/delete.php?id=' . $item['id'])); ?>" data-confirm="Supprimer ce membre ?">
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
