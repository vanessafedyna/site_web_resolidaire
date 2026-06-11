<?php
$page_title = 'Activites';
require_once __DIR__ . '/../includes/header.php';
$activities = Activity::all(true);
require_once __DIR__ . '/../includes/nav.php';
?>
<main id="main-content">
    <section class="page-hero">
        <div class="container">
            <div class="panel">
                <span class="eyebrow">Activites</span>
                <h1>Des rencontres pour apprendre, bouger et creer des liens.</h1>
                <p>Notre programmation favorise la participation sociale et le plaisir d'etre ensemble dans un cadre accueillant.</p>
            </div>
        </div>
    </section>
    <section>
        <div class="container">
            <div class="cards-grid">
                <?php foreach ($activities as $activity): ?>
                    <article class="card">
                        <div class="card-media"><img src="<?= e(upload_url($activity['image'])); ?>" alt="<?= e($activity['title']); ?>"></div>
                        <div class="card-body">
                            <p class="meta"><?= e(format_datetime($activity['activity_date'], $activity['start_time'], $activity['end_time'])); ?></p>
                            <h3><?= e($activity['title']); ?></h3>
                            <p><?= e($activity['description']); ?></p>
                            <?php if ($activity['location']): ?><p><strong>Lieu :</strong> <?= e($activity['location']); ?></p><?php endif; ?>
                            <?php if ($activity['price']): ?><p><strong>Prix :</strong> <?= e($activity['price']); ?></p><?php endif; ?>
                        </div>
                    </article>
                <?php endforeach; ?>
            </div>
        </div>
    </section>
</main>
<?php require_once __DIR__ . '/../includes/footer.php'; ?>
