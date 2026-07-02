<?php
$page_title = 'Accueil';
require_once __DIR__ . '/../includes/header.php';

$featuredServices = Service::featured(4);
$teamMembers = array_slice(TeamMember::all(true), 0, 3);
$activities = Activity::upcoming(3);
$partners = array_slice(Partner::all(true), 0, 4);
$donationCall = DonationCall::activeOne();
$donationCallUrl = normalize_donation_url($donationCall['button_url'] ?? SiteSetting::get('donation_url', ''));
require_once __DIR__ . '/../includes/nav.php';
?>
<main id="main-content">
    <section class="hero">
        <div class="container hero-grid">
            <div class="hero-copy">
                <span class="eyebrow">Pour les aîné·e·s, les proches aidants et les familles du quartier</span>
                <h1>Du soutien concret pour mieux vivre dans le quartier.</h1>
                <p>Résolidaire accompagne les personnes du milieu avec des services de proximité, des activités accessibles et une présence humaine enracinée dans Hochelaga-Maisonneuve.</p>
                <div class="hero-actions">
                    <a class="button" href="<?= e(public_url('contact.php')); ?>">Obtenir de l’aide</a>
                    <a class="button button-secondary" href="<?= e(public_url('activites.php')); ?>">Voir les activités</a>
                </div>
                <a class="hero-secondary-link" href="<?= e(public_url('benevolat.php')); ?>">Devenir bénévole</a>
                <ul class="hero-reassurance" aria-label="Points clés">
                    <li>Services de proximité</li>
                    <li>Activités accessibles</li>
                    <li>Accompagnement humain</li>
                </ul>
            </div>
            <div class="hero-card hero-media">
                <img src="<?= e(asset_url('images/hero/home-hero-photo.png')); ?>" alt="Membre de l'equipe Resolidaire en echange avec des aines lors d'une activite communautaire.">
            </div>
        </div>
    </section>

    <section class="home-services home-services-section">
        <div class="container">
            <h2>Services et soutien</h2>
            <p class="section-intro">Des services de proximité pour soutenir l’autonomie, les déplacements, la vie sociale et l’accès aux ressources du quartier.</p>
            <div class="cards-grid services-grid home-services-grid">
                <?php foreach ($featuredServices as $service): ?>
                    <?php
                    $serviceTitle = (string) ($service['title'] ?? '');
                    $serviceLabel = 'Service de proximité';
                    $serviceTitleNormalized = function_exists('mb_strtolower')
                        ? mb_strtolower($serviceTitle, 'UTF-8')
                        : strtolower($serviceTitle);

                    if (str_contains($serviceTitleNormalized, 'popote')) {
                        $serviceLabel = 'Repas à domicile';
                    } elseif (
                        str_contains($serviceTitleNormalized, 'transport')
                        && (str_contains($serviceTitleNormalized, 'medical') || str_contains($serviceTitleNormalized, 'médical'))
                    ) {
                        $serviceLabel = 'Déplacements';
                    } elseif (str_contains($serviceTitleNormalized, 'epicerie') || str_contains($serviceTitleNormalized, 'épicerie')) {
                        $serviceLabel = 'Courses';
                    } elseif (str_contains($serviceTitleNormalized, 'intervention')) {
                        $serviceLabel = 'Soutien du milieu';
                    }
                    ?>
                    <article class="card service-card">
                        <div class="card-media<?= empty($service['image']) ? ' is-placeholder' : ''; ?>">
                            <?php if (!empty($service['image'])): ?>
                                <img src="<?= e(upload_url($service['image'])); ?>" alt="<?= e($service['title']); ?>">
                            <?php endif; ?>
                        </div>
                        <div class="card-body">
                            <p class="service-label"><?= e($serviceLabel); ?></p>
                            <h3><?= e($service['title']); ?></h3>
                            <p><?= e($service['short_description']); ?></p>
                            <a class="service-card-link" href="<?= e(public_url('services.php')); ?>">En savoir plus &rarr;</a>
                        </div>
                    </article>
                <?php endforeach; ?>
            </div>
            <div class="quick-links">
                <a class="button button-secondary" href="<?= e(public_url('services.php')); ?>">Voir tous les services</a>
            </div>
        </div>
    </section>

    <section>
        <div class="container split-grid">
            <div class="panel">
                <h2>Activites a venir</h2>
                <?php foreach ($activities as $activity): ?>
                    <article>
                        <p class="meta"><?= e(format_datetime($activity['activity_date'], $activity['start_time'], $activity['end_time'])); ?></p>
                        <h3><?= e($activity['title']); ?></h3>
                        <p><?= e($activity['description']); ?></p>
                    </article>
                <?php endforeach; ?>
                <div class="quick-links">
                    <a class="button button-secondary" href="<?= e(public_url('activites.php')); ?>">Voir toutes les activites</a>
                </div>
            </div>
            <div class="panel">
                <h2>Une equipe proche des gens</h2>
                <?php foreach ($teamMembers as $member): ?>
                    <article>
                        <h3><?= e($member['name']); ?></h3>
                        <p class="meta"><?= e($member['job_title']); ?></p>
                        <p><?= e($member['bio']); ?></p>
                    </article>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <?php if ($donationCall): ?>
        <section>
            <div class="container">
                <div class="panel">
                    <span class="eyebrow">Appel a la solidarite</span>
                    <h2><?= e($donationCall['title']); ?></h2>
                    <p><?= e($donationCall['description']); ?></p>
                    <a class="button" href="<?= e($donationCallUrl); ?>" target="_blank" rel="noopener">
                        <?= e($donationCall['button_text'] ?: 'Faire un don'); ?>
                    </a>
                </div>
            </div>
        </section>
    <?php endif; ?>

    <section>
        <div class="container">
            <h2>Partenaires du milieu</h2>
            <div class="cards-grid">
                <?php foreach ($partners as $partner): ?>
                    <article class="card">
                        <div class="card-body">
                            <h3><?= e($partner['name']); ?></h3>
                            <p><?= e($partner['description']); ?></p>
                        </div>
                    </article>
                <?php endforeach; ?>
            </div>
        </div>
    </section>
</main>
<?php require_once __DIR__ . '/../includes/footer.php'; ?>
