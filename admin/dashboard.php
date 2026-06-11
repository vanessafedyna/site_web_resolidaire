<?php
$page_title = 'Tableau de bord';
require_once __DIR__ . '/../includes/admin-header.php';
?>
<?php require_once __DIR__ . '/../includes/admin-sidebar.php'; ?>
<main class="admin-main">
    <div class="admin-topbar">
        <div>
            <h1>Tableau de bord</h1>
            <p>Bienvenue, <?= e($adminUser['name'] ?? ''); ?>.</p>
        </div>
    </div>

    <?php if ($adminFlash): ?>
        <div class="flash-banner flash flash-<?= e($adminFlash['type']); ?>"><?= e($adminFlash['message']); ?></div>
    <?php endif; ?>

    <section class="stats-grid">
        <article class="stat-card"><span>Equipe active</span><strong><?= TeamMember::countActive(); ?></strong></article>
        <article class="stat-card"><span>Activites publiees</span><strong><?= Activity::countPublished(); ?></strong></article>
        <article class="stat-card"><span>Services actifs</span><strong><?= Service::countActive(); ?></strong></article>
        <article class="stat-card"><span>Messages non lus</span><strong><?= Message::countUnread(); ?></strong></article>
    </section>

    <section class="table-card">
        <h2>Acces rapides</h2>
        <div class="actions">
            <a class="button" href="<?= e(admin_url('equipe/create.php')); ?>">Ajouter un membre</a>
            <a class="button" href="<?= e(admin_url('activites/create.php')); ?>">Ajouter une activite</a>
            <a class="button" href="<?= e(admin_url('dons/create.php')); ?>">Ajouter un appel aux dons</a>
            <a class="button button-secondary" href="<?= e(admin_url('settings/index.php')); ?>">Modifier les parametres</a>
        </div>
    </section>
</main>
<?php require_once __DIR__ . '/../includes/admin-footer.php'; ?>
