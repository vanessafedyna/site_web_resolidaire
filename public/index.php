<?php
$page_title = 'Accueil';
require_once __DIR__ . '/../includes/header.php';

$featuredServices = Service::featured(3);
$teamMembers = array_slice(TeamMember::all(true), 0, 3);
$activities = Activity::upcoming(3);
$partners = array_slice(Partner::all(true), 0, 4);
$donationCall = DonationCall::activeOne();
require_once __DIR__ . '/../includes/nav.php';
?>
<main id="main-content">
    <section class="hero">
        <div class="container hero-grid">
            <div class="hero-copy">
                <span class="eyebrow">Pour les aines, proches aidants et voisins solidaires</span>
                <h1>Un point d'ancrage humain pour mieux vivre le quartier.</h1>
                <p>Resolidaire rassemble des services de proximite, des activites et un accompagnement attentif pour soutenir la vie communautaire avec douceur, clarte et respect.</p>
                <div class="quick-links">
                    <a class="button" href="<?= e(public_url('services.php')); ?>">Demander un service</a>
                    <a class="button button-secondary" href="<?= e(public_url('benevolat.php')); ?>">Devenir benevole</a>
                    <a class="button button-secondary" href="<?= e(public_url('contact.php')); ?>">Nous contacter</a>
                    <a class="button button-secondary" href="<?= e(public_url('don.php')); ?>">Faire un don</a>
                </div>
            </div>
            <div class="hero-card hero-media">
                <img src="<?= e(asset_url('images/hero/home-hero-photo.png')); ?>" alt="Membre de l'equipe Resolidaire en echange avec des aines lors d'une activite communautaire.">
            </div>
        </div>
    </section>

    <section>
        <div class="container">
            <h2>Services phares</h2>
            <div class="cards-grid">
                <?php foreach ($featuredServices as $service): ?>
                    <article class="card">
                        <div class="card-media"><img src="<?= e(upload_url($service['image'])); ?>" alt="<?= e($service['title']); ?>"></div>
                        <div class="card-body">
                            <h3><?= e($service['title']); ?></h3>
                            <p><?= e($service['short_description']); ?></p>
                        </div>
                    </article>
                <?php endforeach; ?>
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
                    <a class="button" href="<?= e($donationCall['button_url'] ?: SiteSetting::get('donation_url', '#')); ?>" target="_blank" rel="noopener">
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
