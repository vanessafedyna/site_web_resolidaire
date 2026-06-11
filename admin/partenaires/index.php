<?php
$page_title = 'Gestion des partenaires';
require_once __DIR__ . '/../../includes/admin-header.php';
$items = Partner::all();
?>
<?php require_once __DIR__ . '/../../includes/admin-sidebar.php'; ?>
<main class="admin-main">
    <div class="admin-topbar"><h1>Partenaires</h1><a class="button" href="<?= e(admin_url('partenaires/create.php')); ?>">Ajouter</a></div>
    <?php if ($adminFlash): ?><div class="flash-banner flash flash-<?= e($adminFlash['type']); ?>"><?= e($adminFlash['message']); ?></div><?php endif; ?>
    <section class="table-card">
        <table>
            <thead><tr><th>Nom</th><th>Site web</th><th>Statut</th><th>Actions</th></tr></thead>
            <tbody>
            <?php foreach ($items as $item): ?>
                <tr>
                    <td><?= e($item['name']); ?></td>
                    <td><?= e($item['website_url']); ?></td>
                    <td><span class="status-pill <?= $item['is_active'] ? 'status-active' : 'status-inactive'; ?>"><?= $item['is_active'] ? 'Actif' : 'Inactif'; ?></span></td>
                    <td class="actions">
                        <a class="button button-secondary" href="<?= e(admin_url('partenaires/edit.php?id=' . $item['id'])); ?>">Modifier</a>
                        <form class="inline-form" method="post" action="<?= e(admin_url('partenaires/delete.php?id=' . $item['id'])); ?>" data-confirm="Supprimer ce partenaire ?">
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
