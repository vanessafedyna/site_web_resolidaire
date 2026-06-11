<?php
$page_title = 'Faire un don';
require_once __DIR__ . '/../includes/header.php';
$donationCalls = DonationCall::all(true);
$externalDonationUrl = SiteSetting::get('donation_url', '#');
require_once __DIR__ . '/../includes/nav.php';
?>
<main id="main-content">
    <section class="page-hero">
        <div class="container">
            <div class="panel">
                <span class="eyebrow">Faire un don</span>
                <h1>Soutenir des actions locales utiles, visibles et humaines.</h1>
                <p>Chaque contribution aide a maintenir des services accessibles et des activites rassembleuses pour la communaute.</p>
                <a class="button" href="<?= e($externalDonationUrl); ?>" target="_blank" rel="noopener">Donner en ligne</a>
            </div>
        </div>
    </section>
    <section>
        <div class="container">
            <div class="cards-grid">
                <?php foreach ($donationCalls as $call): ?>
                    <article class="card">
                        <div class="card-media"><img src="<?= e(upload_url($call['image'])); ?>" alt="<?= e($call['title']); ?>"></div>
                        <div class="card-body">
                            <h3><?= e($call['title']); ?></h3>
                            <p><?= e($call['description']); ?></p>
                            <a class="button button-secondary" href="<?= e($call['button_url'] ?: $externalDonationUrl); ?>" target="_blank" rel="noopener">
                                <?= e($call['button_text'] ?: 'Contribuer'); ?>
                            </a>
                        </div>
                    </article>
                <?php endforeach; ?>
            </div>
        </div>
    </section>
</main>
<?php require_once __DIR__ . '/../includes/footer.php'; ?>
