<?php
$page_title = 'Accueil';
require_once __DIR__ . '/../includes/header.php';

$homeServiceCards = [
    [
        'label' => 'Repas à domicile',
        'title' => 'Popote roulante',
        'text' => 'Livraison de repas chauds à domicile pour soutenir l’autonomie et le maintien à domicile.',
        'icon' => 'utensils',
        'tone' => 'sun',
    ],
    [
        'label' => 'Déplacements',
        'title' => 'Accompagnement médical',
        'text' => 'Accompagnement bénévole vers les rendez-vous médicaux, selon les disponibilités.',
        'icon' => 'car',
        'tone' => 'cream',
    ],
    [
        'label' => 'Courses',
        'title' => 'Transport vers l’épicerie',
        'text' => 'Transport organisé vers certains points d’alimentation du quartier.',
        'icon' => 'shopping-bag',
        'tone' => 'soft',
    ],
    [
        'label' => 'Soutien du milieu',
        'title' => 'Intervention de milieu',
        'text' => 'Écoute, orientation et présence de proximité dans le quartier.',
        'icon' => 'heart-handshake',
        'tone' => 'dark',
    ],
];
$activities = Activity::upcoming(3);
$partners = array_slice(Partner::all(true), 0, 4);
$donationCall = DonationCall::activeOne();
$donationCallUrl = normalize_donation_url($donationCall['button_url'] ?? SiteSetting::get('donation_url', ''));
$homeActivitiesMonthLabel = 'À venir';
$homeActivitiesYearLabel = date('Y');

if (!empty($activities[0]['activity_date'])) {
    $firstActivityTimestamp = strtotime((string) $activities[0]['activity_date']);

    if ($firstActivityTimestamp) {
        $homeActivityMonths = [
            1 => 'Janvier',
            2 => 'Février',
            3 => 'Mars',
            4 => 'Avril',
            5 => 'Mai',
            6 => 'Juin',
            7 => 'Juillet',
            8 => 'Août',
            9 => 'Septembre',
            10 => 'Octobre',
            11 => 'Novembre',
            12 => 'Décembre',
        ];

        $homeActivitiesMonthLabel = $homeActivityMonths[(int) date('n', $firstActivityTimestamp)] ?? $homeActivitiesMonthLabel;
        $homeActivitiesYearLabel = date('Y', $firstActivityTimestamp);
    }
}
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
            <div class="home-services-heading">
                <div class="home-services-heading-main">
                    <h2 class="home-services-title">Services et soutien</h2>
                    <span class="home-services-heading-accent" aria-hidden="true"></span>
                    <p class="section-intro">Des services concrets pour soutenir l’autonomie, les déplacements, l’alimentation et le maintien du lien social.</p>
                </div>
            </div>
            <div class="cards-grid services-grid home-services-grid">
                <?php foreach ($homeServiceCards as $card): ?>
                    <article class="card service-card home-service-card home-service-card--<?= e($card['tone']); ?>">
                        <div class="home-service-card-body">
                            <div class="home-service-icon" aria-hidden="true">
                                <i data-lucide="<?= e($card['icon']); ?>" aria-hidden="true"></i>
                            </div>
                            <p class="service-label home-service-label"><?= e($card['label']); ?></p>
                            <h3><?= e($card['title']); ?></h3>
                            <p><?= e($card['text']); ?></p>
                            <a class="service-card-link home-service-link" href="<?= e(public_url('services.php')); ?>" aria-label="En savoir plus sur <?= e($card['title']); ?>">
                                En savoir plus <span aria-hidden="true">&rarr;</span>
                            </a>
                        </div>
                    </article>
                <?php endforeach; ?>
            </div>
            <div class="quick-links">
                <a class="button button-secondary" href="<?= e(public_url('services.php')); ?>">Voir tous les services</a>
            </div>
        </div>
    </section>

    <section class="home-activities-section">
        <div class="container">
            <div class="home-activities-inner">
                <div class="home-activities-heading">
                    <div class="home-activities-kicker" aria-hidden="true">
                        <i class="home-activities-calendar-icon" data-lucide="calendar-days" aria-hidden="true"></i>
                    </div>
                    <div class="home-activities-heading-main">
                        <h2 class="home-activities-title">Activités à venir</h2>
                        <p class="section-intro">Des rencontres, ateliers et moments de vie communautaire pour rester actif·ve, informé·e et entouré·e.</p>
                    </div>
                    <a class="home-activities-details-link" href="<?= e(public_url('activites.php')); ?>">Détails</a>
                </div>
                <div class="home-activities-divider" aria-hidden="true"></div>

                <div class="home-activities-program">
                    <aside class="home-activities-rail" aria-label="Repère temporel">
                        <span class="home-activities-month"><?= e($homeActivitiesMonthLabel); ?></span>
                        <span class="home-activities-line"></span>
                        <strong class="home-activities-year"><?= e($homeActivitiesYearLabel); ?></strong>
                    </aside>

                    <div class="home-activities-listing">
                        <?php if ($activities): ?>
                            <div class="home-activities-list">
                                <?php foreach ($activities as $activity): ?>
                                    <?php
                                    $activityDate = !empty($activity['activity_date']) ? format_date((string) $activity['activity_date']) : '';
                                    $activityTime = '';

                                    if (!empty($activity['start_time'])) {
                                        $activityTime = substr((string) $activity['start_time'], 0, 5);

                                        if (!empty($activity['end_time'])) {
                                            $activityTime .= ' à ' . substr((string) $activity['end_time'], 0, 5);
                                        }
                                    }
                                    ?>
                                    <article class="home-activity-row">
                                        <div class="home-activity-meta">
                                            <p class="home-activity-label">Activité communautaire</p>
                                            <?php if ($activityDate): ?>
                                                <p class="home-activity-date"><?= e($activityDate); ?></p>
                                            <?php endif; ?>
                                            <?php if ($activityTime): ?>
                                                <p class="home-activity-time"><?= e($activityTime); ?></p>
                                            <?php endif; ?>
                                            <?php if (!empty($activity['location'])): ?>
                                                <p class="home-activity-place"><strong>Lieu :</strong> <?= e($activity['location']); ?></p>
                                            <?php endif; ?>
                                        </div>

                                        <div class="home-activity-content">
                                            <h3><?= e($activity['title'] ?? 'Activité'); ?></h3>
                                            <p><?= e($activity['description'] ?? ''); ?></p>
                                        </div>

                                        <div class="home-activity-action">
                                            <a class="button button-secondary" href="<?= e(public_url('activites.php')); ?>">Voir</a>
                                            <a class="home-activity-link" href="<?= e(public_url('activites.php')); ?>" aria-label="Voir la programmation de <?= e($activity['title'] ?? 'cette activité'); ?>">&rarr;</a>
                                        </div>
                                    </article>
                                <?php endforeach; ?>
                            </div>
                        <?php else: ?>
                            <div class="panel home-activities-empty">
                                <p>Aucune activité à venir n’est publiée pour le moment. Contactez-nous pour connaître la programmation.</p>
                                <a class="button" href="<?= e(public_url('contact.php')); ?>">Nous contacter</a>
                            </div>
                        <?php endif; ?>

                        <div class="quick-links home-activities-footer">
                            <a class="button" href="<?= e(public_url('activites.php')); ?>">Voir toutes les activités</a>
                        </div>
                    </div>
                </div>
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
