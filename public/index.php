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

$homePartnersHasRealData = !empty($partners);
$homePartnerIcons = ['building-2', 'heart-pulse', 'users', 'map-pin'];
$homePartnerCards = [];

if ($homePartnersHasRealData) {
    foreach ($partners as $index => $partner) {
        $homePartnerCards[] = [
            'title' => (string) ($partner['name'] ?? 'Partenaire local'),
            'text' => trim((string) ($partner['description'] ?? '')) ?: 'Collaboration locale pour renforcer le soutien offert dans le quartier.',
            'icon' => $homePartnerIcons[$index % count($homePartnerIcons)],
            'url' => !empty($partner['website_url']) ? (string) $partner['website_url'] : '',
        ];
    }
} else {
    $homePartnerCards = [
        [
            'title' => 'Organismes communautaires',
            'text' => 'Collaboration avec les ressources locales du quartier.',
            'icon' => 'building-2',
            'url' => '',
        ],
        [
            'title' => 'Services de sante et de proximite',
            'text' => 'References, accompagnement et soutien aux personnes selon les besoins.',
            'icon' => 'heart-pulse',
            'url' => '',
        ],
        [
            'title' => 'Benevoles et citoyens engages',
            'text' => 'Une implication humaine essentielle a la vie de l organisme.',
            'icon' => 'users',
            'url' => '',
        ],
        [
            'title' => 'Milieu local',
            'text' => 'Des liens avec les acteurs du quartier pour mieux repondre aux besoins.',
            'icon' => 'map-pin',
            'url' => '',
        ],
    ];
}

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

    <section class="home-community-section">
        <div class="home-community-inner">
            <div class="home-community-content">
                <h2 class="home-community-title">Un lieu pour rester entour&#233;&#183;e</h2>
                <p class="home-community-text">R&#233;solidaire est un point d&rsquo;ancrage dans le quartier. L&rsquo;organisme offre un espace de confiance o&#249; les personnes a&#238;n&#233;es peuvent recevoir du soutien, participer &#224; des activit&#233;s et maintenir des liens avec leur communaut&#233;.</p>
                <div class="quick-links home-community-actions">
                    <a class="button" href="<?= e(public_url('a-propos.php')); ?>">Nous conna&#238;tre</a>
                    <a class="button button-secondary" href="<?= e(public_url('contact.php')); ?>">Nous contacter</a>
                </div>
            </div>
            <div class="home-community-visual">
                <div class="home-community-media">
                    <img src="<?= e(asset_url('images/hero/home-hero-photo.png')); ?>" alt="Personnes ainees et intervenante de Resolidaire reunies autour d'une table dans le local communautaire.">
                </div>
                <div class="home-community-card">
                    <div class="home-community-icon" aria-hidden="true">
                        <i data-lucide="users" aria-hidden="true"></i>
                    </div>
                    <p>Pr&#233;sence de proximit&#233;</p>
                </div>
            </div>
        </div>
    </section>

    <section class="home-contact-strip" aria-labelledby="home-contact-strip-title">
        <div class="container">
            <div class="home-contact-strip-inner">
                <div class="home-contact-strip-content">
                    <h2 class="home-contact-strip-title" id="home-contact-strip-title">Restez en contact</h2>
                    <p class="home-contact-strip-text">Une question sur nos services, nos activit&#233;s ou le b&#233;n&#233;volat&nbsp;?</p>
                </div>
                <div class="home-contact-strip-actions">
                    <a class="button" href="<?= e(public_url('contact.php')); ?>">
                        <i data-lucide="message-circle" aria-hidden="true"></i>
                        <span>Nous contacter</span>
                    </a>
                    <a class="home-contact-strip-phone" href="tel:5145989670">
                        <i data-lucide="phone" aria-hidden="true"></i>
                        <span>514-598-9670</span>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <section class="home-engagement-section" aria-labelledby="home-engagement-title">
        <div class="container">
            <div class="home-engagement-inner">
                <div class="home-engagement-heading">
                    <h2 class="home-engagement-title" id="home-engagement-title">S&rsquo;impliquer avec R&#233;solidaire</h2>
                    <p class="home-engagement-text">Que ce soit par du temps, un don ou un engagement professionnel, chaque contribution aide &#224; soutenir les personnes a&#238;n&#233;es du quartier.</p>
                </div>

                <div class="home-engagement-grid">
                    <a class="home-engagement-card home-engagement-card--volunteer" href="<?= e(public_url('benevolat.php')); ?>">
                        <div class="home-engagement-icon" aria-hidden="true">
                            <i data-lucide="users" aria-hidden="true"></i>
                        </div>
                        <div>
                            <h3>Devenir b&#233;n&#233;vole</h3>
                            <p>Offrez du temps, de l&rsquo;&#233;coute ou un coup de main aux personnes du quartier.</p>
                        </div>
                        <span class="home-engagement-arrow" aria-hidden="true">&rarr;</span>
                    </a>

                    <a class="home-engagement-card home-engagement-card--donation" href="<?= e(public_url('don.php')); ?>">
                        <div class="home-engagement-icon" aria-hidden="true">
                            <i data-lucide="hand-heart" aria-hidden="true"></i>
                        </div>
                        <div>
                            <h3>Faire un don</h3>
                            <p>Soutenez les services de proximit&#233;, les activit&#233;s et l&rsquo;accompagnement offert aux a&#238;n&#233;&#183;e&#183;s.</p>
                        </div>
                        <span class="home-engagement-arrow" aria-hidden="true">&rarr;</span>
                    </a>

                    <a class="home-engagement-card home-engagement-card--career" href="<?= e(public_url('a-propos.php#carrieres')); ?>">
                        <div class="home-engagement-icon" aria-hidden="true">
                            <i data-lucide="briefcase-business" aria-hidden="true"></i>
                        </div>
                        <div>
                            <h3>Carri&#232;res</h3>
                            <p>Consultez les possibilit&#233;s d&rsquo;emploi, de stage ou de candidature spontan&#233;e.</p>
                        </div>
                        <span class="home-engagement-arrow" aria-hidden="true">&rarr;</span>
                    </a>
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

    <section class="home-partners-section" aria-labelledby="home-partners-title">
        <div class="container">
            <div class="home-partners-inner">
                <div class="home-partners-heading">
                    <h2 class="home-partners-title" id="home-partners-title">Partenaires du milieu</h2>
                    <p class="home-partners-text">R&#233;solidaire collabore avec des partenaires locaux afin de renforcer le soutien offert aux personnes a&#238;n&#233;es, aux proches aidants et aux familles du quartier.</p>
                </div>
                <div class="home-partners-grid">
                    <?php foreach ($homePartnerCards as $partnerCard): ?>
                        <article class="home-partner-card">
                            <div class="home-partner-icon" aria-hidden="true">
                                <i data-lucide="<?= e($partnerCard['icon']); ?>" aria-hidden="true"></i>
                            </div>
                            <div class="home-partner-copy">
                                <h3 class="home-partner-title"><?= e($partnerCard['title']); ?></h3>
                                <p class="home-partner-text"><?= e($partnerCard['text']); ?></p>
                            </div>
                            <?php if (!empty($partnerCard['url'])): ?>
                                <a class="home-partner-link" href="<?= e($partnerCard['url']); ?>" target="_blank" rel="noopener">
                                    Visiter le site <span aria-hidden="true">&rarr;</span>
                                </a>
                            <?php endif; ?>
                        </article>
                    <?php endforeach; ?>
                </div>
                <div class="home-partners-actions">
                    <a class="button button-secondary" href="<?= e(public_url('partenaires.php')); ?>">Voir tous les partenaires</a>
                </div>
            </div>
        </div>
    </section>
</main>
<?php require_once __DIR__ . '/../includes/footer.php'; ?>
