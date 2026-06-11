<?php
$page_title = 'Benevolat';
$page_css = 'css/benevolat.css';
require_once __DIR__ . '/../includes/header.php';
require_once __DIR__ . '/../includes/nav.php';

$benevolatContactHref = !empty($siteSettings['email'] ?? '') ? 'mailto:' . $siteSettings['email'] : public_url('contact.php');
$campaignGallery = [
    ['path' => 'images/benevolat/affiche-1.svg', 'title' => 'Affiche de recrutement benevole de Resolidaire mettant en valeur une facon de s impliquer.'],
    ['path' => 'images/benevolat/affiche-2.svg', 'title' => 'Affiche de recrutement benevole de Resolidaire pour une implication communautaire.'],
    ['path' => 'images/benevolat/affiche-3.svg', 'title' => 'Affiche de campagne benevolat de Resolidaire pour inviter a s engager.'],
    ['path' => 'images/benevolat/affiche-4.svg', 'title' => 'Affiche de recrutement benevole de Resolidaire presentant un role de soutien.'],
    ['path' => 'images/benevolat/affiche-5.svg', 'title' => 'Affiche de campagne benevolat de Resolidaire pour encourager la participation.'],
];
$volunteerRoles = [
    [
        'title' => 'Chauffeur·se / baladeur·se',
        'text' => 'Accompagner des personnes dans leurs deplacements et contribuer a briser l isolement.',
    ],
    [
        'title' => 'Accompagnateur·trice au transport medical',
        'text' => 'Offrir une presence rassurante lors de deplacements vers des rendez-vous medicaux.',
    ],
    [
        'title' => 'Aide aux activites',
        'text' => 'Soutenir l equipe lors des activites collectives, ateliers et moments de rencontre.',
    ],
    [
        'title' => 'Reception et accueil',
        'text' => 'Accueillir, orienter et repondre aux personnes qui communiquent avec l organisme.',
    ],
    [
        'title' => 'Aide au bingo hebdomadaire',
        'text' => 'Participer a l organisation et au bon deroulement du bingo.',
    ],
    [
        'title' => 'Soutien ponctuel',
        'text' => 'Donner un coup de main selon les besoins de l organisme et vos disponibilites.',
    ],
];
$volunteerBenefits = [
    [
        'title' => 'Creer des liens',
        'text' => 'Rencontrer des personnes du quartier et participer a une vie communautaire active.',
    ],
    [
        'title' => 'Se sentir utile',
        'text' => 'Contribuer concretement au bien-etre des aines, des proches aidants et des familles.',
    ],
    [
        'title' => 'Etre accompagne',
        'text' => 'Les benevoles sont soutenus par l equipe de Resolidaire dans leurs taches.',
    ],
    [
        'title' => 'S impliquer selon ses disponibilites',
        'text' => 'Les besoins sont varies et peuvent s adapter au temps que vous souhaitez offrir.',
    ],
];
$humanPhoto = [
    'path' => 'images/benevolat/benevoles-groupe.jpg',
    'title' => 'Benevoles de Resolidaire en contexte communautaire',
];
$humanPhotoFile = ASSETS_PATH . '/' . ltrim($humanPhoto['path'], '/');
?>
<main id="main-content">
    <section class="page-hero benevolat-hero">
        <div class="container">
            <div class="panel benevolat-hero-panel">
                <div class="benevolat-hero-grid">
                    <div class="benevolat-hero-copy">
                        <span class="eyebrow">Benevolat</span>
                        <h1>Donner du temps, creer des liens, faire une vraie difference.</h1>
                        <p>Les benevoles jouent un role essentiel dans l accueil, les activites, les services et la vie de quartier.</p>
                        <a class="button" href="#devenir-benevole">Je veux devenir benevole</a>
                    </div>
                    <div class="benevolat-hero-media">
                        <?php if (is_file($humanPhotoFile)): ?>
                            <img src="<?= e(asset_url($humanPhoto['path'])); ?>" alt="<?= e($humanPhoto['title']); ?>">
                        <?php else: ?>
                            <div class="benevolat-gallery-placeholder" role="img" aria-label="<?= e($humanPhoto['title']); ?>">
                                <span>Photo a ajouter</span>
                                <small><?= e('assets/' . ltrim($humanPhoto['path'], '/')); ?></small>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="benevolat-positions" id="postes-recherches">
        <div class="container">
            <div class="benevolat-section-heading">
                <h2>Postes recherches</h2>
            </div>
            <div class="benevolat-positions-grid">
                <?php foreach ($volunteerRoles as $role): ?>
                    <article class="benevolat-card">
                        <span class="benevolat-dot" aria-hidden="true"></span>
                        <h3><?= e($role['title']); ?></h3>
                        <p><?= e($role['text']); ?></p>
                    </article>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <section class="benevolat-benefits">
        <div class="container">
            <div class="benevolat-section-heading">
                <h2>Pourquoi s impliquer ?</h2>
                <p>Le benevolat permet de renforcer les liens de quartier, de partager ses talents et de contribuer directement au mieux-etre collectif.</p>
            </div>
            <div class="benevolat-benefits-grid">
                <?php foreach ($volunteerBenefits as $benefit): ?>
                    <article class="benevolat-card benevolat-benefit-card">
                        <h3><?= e($benefit['title']); ?></h3>
                        <p><?= e($benefit['text']); ?></p>
                    </article>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <section class="benevolat-gallery">
        <div class="container">
            <div class="benevolat-section-heading">
                <h2>Nos visuels de recrutement</h2>
                <p>Decouvrez differentes facons de contribuer a la mission de Resolidaire.</p>
            </div>
            <div class="benevolat-carousel" data-carousel aria-label="Carrousel des visuels de recrutement" tabindex="0">
                <div class="benevolat-carousel-shell">
                    <button class="benevolat-carousel-control benevolat-carousel-control-prev" type="button" data-carousel-prev aria-label="Afficher le visuel precedent">
                        <span aria-hidden="true">&#8249;</span>
                    </button>
                    <div class="benevolat-carousel-viewport" data-carousel-viewport>
                        <div class="benevolat-carousel-track" data-carousel-track>
                            <?php foreach ($campaignGallery as $index => $poster): ?>
                                <?php $posterFile = ASSETS_PATH . '/' . ltrim($poster['path'], '/'); ?>
                                <article class="benevolat-carousel-slide" data-carousel-slide aria-label="Visuel <?= $index + 1; ?> sur <?= count($campaignGallery); ?>">
                                    <div class="benevolat-gallery-card">
                                        <?php if (is_file($posterFile)): ?>
                                            <img src="<?= e(asset_url($poster['path'])); ?>" alt="<?= e($poster['title']); ?>">
                                        <?php else: ?>
                                            <div class="benevolat-gallery-placeholder" role="img" aria-label="<?= e($poster['title']); ?>">
                                                <span>Visuel a ajouter</span>
                                                <small><?= e('assets/' . ltrim($poster['path'], '/')); ?></small>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </article>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    <button class="benevolat-carousel-control benevolat-carousel-control-next" type="button" data-carousel-next aria-label="Afficher le visuel suivant">
                        <span aria-hidden="true">&#8250;</span>
                    </button>
                </div>
                <div class="benevolat-carousel-pagination" data-carousel-pagination aria-label="Pagination du carrousel">
                    <?php foreach ($campaignGallery as $index => $poster): ?>
                        <button class="benevolat-carousel-dot<?= $index === 0 ? ' is-active' : ''; ?>" type="button" data-carousel-dot="<?= $index; ?>" aria-label="Aller au visuel <?= $index + 1; ?>" aria-current="<?= $index === 0 ? 'true' : 'false'; ?>"></button>
                    <?php endforeach; ?>
                </div>
                <div class="benevolat-carousel-footer">
                    <a class="button button-secondary" href="#postes-recherches">Voir tous les profils recherches</a>
                </div>
            </div>
        </div>
    </section>

    <section class="benevolat-cta" id="devenir-benevole">
        <div class="container">
            <div class="panel benevolat-cta-panel">
                <h2>Vous souhaitez donner du temps a Resolidaire ?</h2>
                <p>Ecrivez-nous pour discuter des possibilites de benevolat et trouver une implication qui correspond a vos disponibilites.</p>
                <div class="quick-links">
                    <a class="button" href="<?= e($benevolatContactHref); ?>">Nous ecrire pour benevoler</a>
                    <a class="button button-secondary" href="<?= e(public_url('contact.php')); ?>">Nous contacter</a>
                </div>
            </div>
        </div>
    </section>
</main>
<script>
document.addEventListener('DOMContentLoaded', function () {
    var carousel = document.querySelector('[data-carousel]');
    if (!carousel) {
        return;
    }

    var viewport = carousel.querySelector('[data-carousel-viewport]');
    var slides = Array.from(carousel.querySelectorAll('[data-carousel-slide]'));
    var prevButton = carousel.querySelector('[data-carousel-prev]');
    var nextButton = carousel.querySelector('[data-carousel-next]');
    var dots = Array.from(carousel.querySelectorAll('[data-carousel-dot]'));
    var currentIndex = 0;

    function getSlideOffset(index) {
        if (!slides[index]) {
            return 0;
        }

        return slides[index].offsetLeft - viewport.offsetLeft;
    }

    function updateControls(index) {
        currentIndex = index;
        prevButton.disabled = index === 0;
        nextButton.disabled = index === slides.length - 1;

        dots.forEach(function (dot, dotIndex) {
            var isActive = dotIndex === index;
            dot.classList.toggle('is-active', isActive);
            dot.setAttribute('aria-current', isActive ? 'true' : 'false');
        });
    }

    function goToSlide(index) {
        var safeIndex = Math.max(0, Math.min(index, slides.length - 1));
        viewport.scrollTo({
            left: getSlideOffset(safeIndex),
            behavior: 'smooth'
        });
        updateControls(safeIndex);
    }

    function syncFromScroll() {
        var closestIndex = 0;
        var closestDistance = Number.POSITIVE_INFINITY;

        slides.forEach(function (slide, index) {
            var distance = Math.abs(viewport.scrollLeft - getSlideOffset(index));
            if (distance < closestDistance) {
                closestDistance = distance;
                closestIndex = index;
            }
        });

        updateControls(closestIndex);
    }

    prevButton.addEventListener('click', function () {
        goToSlide(currentIndex - 1);
    });

    nextButton.addEventListener('click', function () {
        goToSlide(currentIndex + 1);
    });

    dots.forEach(function (dot) {
        dot.addEventListener('click', function () {
            goToSlide(Number(dot.getAttribute('data-carousel-dot')));
        });
    });

    carousel.addEventListener('keydown', function (event) {
        if (event.key === 'ArrowLeft') {
            event.preventDefault();
            goToSlide(currentIndex - 1);
        }

        if (event.key === 'ArrowRight') {
            event.preventDefault();
            goToSlide(currentIndex + 1);
        }
    });

    var scrollTimeout;
    viewport.addEventListener('scroll', function () {
        window.clearTimeout(scrollTimeout);
        scrollTimeout = window.setTimeout(syncFromScroll, 80);
    }, { passive: true });

    window.addEventListener('resize', function () {
        goToSlide(currentIndex);
    });

    updateControls(0);
});
</script>
<?php require_once __DIR__ . '/../includes/footer.php'; ?>
