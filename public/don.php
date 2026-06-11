<?php
$page_title = 'Faire un don';
$page_css = 'css/don.css';
require_once __DIR__ . '/../includes/header.php';
$externalDonationUrl = SiteSetting::get('donation_url', '#');
require_once __DIR__ . '/../includes/nav.php';

$donImage = [
    'path' => 'images/dons/don-communaute.jpg',
    'alt' => 'Personnes de la communaute reunies dans un contexte de soutien de quartier.',
];
$donImageFile = ASSETS_PATH . '/' . ltrim($donImage['path'], '/');
$impactCards = [
    [
        'title' => 'Securite alimentaire',
        'text' => 'Contribuer a la livraison de repas complets et accessibles.',
    ],
    [
        'title' => 'Maintien a domicile',
        'text' => 'Soutenir des services qui favorisent l autonomie des personnes accompagnees.',
    ],
    [
        'title' => 'Activites et ateliers',
        'text' => 'Offrir des moments de rencontre, de formation et de participation sociale.',
    ],
    [
        'title' => 'Entraide de quartier',
        'text' => 'Renforcer les liens, l ecoute et la solidarite dans le milieu.',
    ],
];
$donMethods = [
    [
        'title' => 'Donner en ligne',
        'text' => 'Faites un don securise en ligne par la plateforme Canadon.',
        'button' => 'Donner via Canadon',
        'href' => $externalDonationUrl,
        'external' => true,
    ],
    [
        'title' => 'Donner directement aux bureaux',
        'text' => 'Vous pouvez aussi contribuer directement aux bureaux de Resolidaire.',
        'address' => '2502 Ave. Desjardins, Montreal',
    ],
    [
        'title' => 'Nous contacter',
        'text' => 'Pour toute question sur les dons, communiquez avec l equipe de Resolidaire.',
        'button' => 'Nous contacter',
        'href' => public_url('contact.php'),
        'external' => false,
    ],
];
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

    <section class="don-mission">
        <div class="container don-mission-grid">
            <div class="don-mission-copy">
                <h2>Votre don soutient concretement la vie de quartier</h2>
                <p>Soutenir Resolidaire, c est contribuer a l autonomie, au maintien a domicile et a la qualite de vie des personnes ainees, des proches aidants et des familles du quartier Hochelaga-Maisonneuve.</p>
            </div>
            <div class="don-mission-media">
                <?php if (is_file($donImageFile)): ?>
                    <img src="<?= e(asset_url($donImage['path'])); ?>" alt="<?= e($donImage['alt']); ?>">
                <?php else: ?>
                    <div class="don-placeholder" role="img" aria-label="<?= e($donImage['alt']); ?>">
                        <span>Photo a ajouter</span>
                        <small><?= e('assets/' . ltrim($donImage['path'], '/')); ?></small>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </section>

    <section class="don-impact">
        <div class="container">
            <div class="don-section-heading">
                <h2>Ce que votre don permet</h2>
            </div>
            <div class="don-impact-grid">
                <?php foreach ($impactCards as $card): ?>
                    <article class="don-card">
                        <span class="don-dot" aria-hidden="true"></span>
                        <h3><?= e($card['title']); ?></h3>
                        <p><?= e($card['text']); ?></p>
                    </article>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <section class="don-methods">
        <div class="container">
            <div class="don-section-heading">
                <h2>Facons de donner</h2>
            </div>
            <div class="don-methods-grid">
                <?php foreach ($donMethods as $method): ?>
                    <article class="don-card don-method-card">
                        <h3><?= e($method['title']); ?></h3>
                        <p><?= e($method['text']); ?></p>
                        <?php if (!empty($method['address'])): ?>
                            <p class="don-address"><strong>Adresse :</strong> <?= e($method['address']); ?></p>
                        <?php endif; ?>
                        <?php if (!empty($method['button'])): ?>
                            <a
                                class="button<?= $method['title'] === 'Nous contacter' ? ' button-secondary' : ''; ?>"
                                href="<?= e($method['href']); ?>"
                                <?= !empty($method['external']) ? 'target="_blank" rel="noopener"' : ''; ?>
                            >
                                <?= e($method['button']); ?>
                            </a>
                        <?php endif; ?>
                    </article>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <section class="don-cta">
        <div class="container">
            <div class="panel don-cta-panel">
                <h2>Chaque contribution compte.</h2>
                <p>Votre soutien aide Resolidaire a poursuivre sa mission aupres des personnes du quartier.</p>
                <div class="quick-links">
                    <a class="button" href="<?= e($externalDonationUrl); ?>" target="_blank" rel="noopener">Donner en ligne</a>
                    <a class="button button-secondary" href="<?= e(public_url('contact.php')); ?>">Nous contacter</a>
                </div>
            </div>
        </div>
    </section>
</main>
<?php require_once __DIR__ . '/../includes/footer.php'; ?>
