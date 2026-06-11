<?php
$page_title = 'Equipe';
require_once __DIR__ . '/../includes/header.php';
$members = TeamMember::all(true);
require_once __DIR__ . '/../includes/nav.php';
?>
<main id="main-content">
    <section class="page-hero">
        <div class="container">
            <div class="panel">
                <span class="eyebrow">Equipe</span>
                <h1>Des visages connus, disponibles et attentifs.</h1>
                <p>Notre equipe est la pour accompagner les membres avec chaleur, ecoute et professionnalisme.</p>
            </div>
        </div>
    </section>
    <section>
        <div class="container">
            <div class="cards-grid">
                <?php foreach ($members as $member): ?>
                    <article class="card">
                        <div class="card-media"><img src="<?= e(upload_url($member['photo'])); ?>" alt="<?= e($member['name']); ?>"></div>
                        <div class="card-body">
                            <h3><?= e($member['name']); ?></h3>
                            <p class="meta"><?= e($member['job_title']); ?></p>
                            <p><?= e($member['bio']); ?></p>
                            <?php if ($member['email']): ?><p><a href="mailto:<?= e($member['email']); ?>"><?= e($member['email']); ?></a></p><?php endif; ?>
                            <?php if ($member['phone_extension']): ?><p>Poste <?= e($member['phone_extension']); ?></p><?php endif; ?>
                        </div>
                    </article>
                <?php endforeach; ?>
            </div>
        </div>
    </section>
</main>
<?php require_once __DIR__ . '/../includes/footer.php'; ?>
