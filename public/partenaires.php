<?php
$page_title = 'Partenaires';
require_once __DIR__ . '/../includes/header.php';
$partners = Partner::all(true);
require_once __DIR__ . '/../includes/nav.php';
?>
<main id="main-content">
    <section class="page-hero">
        <div class="container">
            <div class="panel">
                <span class="eyebrow">Partenaires</span>
                <h1>Des collaborations qui renforcent l'entraide locale.</h1>
                <p>Resolidaire travaille avec des organismes, institutions et acteurs du milieu afin d'offrir des reponses mieux coordonnees.</p>
            </div>
        </div>
    </section>
    <section>
        <div class="container">
            <div class="cards-grid">
                <?php foreach ($partners as $partner): ?>
                    <article class="card">
                        <div class="card-body">
                            <h3><?= e($partner['name']); ?></h3>
                            <p><?= e($partner['description']); ?></p>
                            <?php if ($partner['website_url']): ?>
                                <a class="button button-secondary" href="<?= e($partner['website_url']); ?>" target="_blank" rel="noopener">Visiter le site</a>
                            <?php endif; ?>
                        </div>
                    </article>
                <?php endforeach; ?>
            </div>
        </div>
    </section>
</main>
<?php require_once __DIR__ . '/../includes/footer.php'; ?>
