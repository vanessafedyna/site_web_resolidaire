<?php
$page_title = 'Services';
$page_css = 'css/services.css';
require_once __DIR__ . '/../includes/header.php';
require_once __DIR__ . '/../includes/nav.php';

$services = Service::all(true);
$servicePlaceholders = [
    'transport-medical' => 'assets/images/services/transport-medical.jpg',
    'epicerie' => 'assets/images/services/transport-epicerie.jpg',
    'intervention' => 'assets/images/services/intervention-milieu.jpg',
];
$serviceRequestHref = !empty($services[0]['slug']) ? '#' . $services[0]['slug'] : public_url('contact.php');
?>
<main id="main-content">
    <section class="page-hero">
        <div class="container">
            <div class="panel">
                <span class="eyebrow">Services</span>
                <h1>Des services simples, humains et accessibles.</h1>
                <p>Decouvrez les services offerts aux aines, aux proches aidants et aux personnes du quartier.</p>
            </div>
        </div>
    </section>

    <section class="services-intro">
        <div class="container">
            <p>Les services de Resolidaire s'adressent aux aines, aux proches aidants et aux personnes vivant une situation de vulnerabilite dans le quartier Hochelaga-Maisonneuve.</p>
        </div>
    </section>

    <section class="services-overview">
        <div class="container">
            <?php if ($services): ?>
                <div class="services-cards-grid">
                    <?php foreach ($services as $service): ?>
                        <article class="service-card">
                            <a class="service-card-link" href="#<?= e($service['slug']); ?>">
                                <h2><?= e($service['title']); ?></h2>
                                <p><?= e($service['short_description']); ?></p>
                                <span class="button button-secondary">En savoir plus</span>
                            </a>
                        </article>
                    <?php endforeach; ?>
                </div>
            <?php else: ?>
                <div class="panel services-panel">
                    <p>Aucun service n'est disponible pour le moment.</p>
                </div>
            <?php endif; ?>
        </div>
    </section>

    <?php if ($services): ?>
        <section class="services-detail-list">
            <div class="container services-detail-stack">
                <?php foreach ($services as $index => $service): ?>
                    <?php
                    $detailClasses = 'service-detail';
                    if ($index % 2 === 1) {
                        $detailClasses .= ' service-detail-reverse';
                    }

                    $detailItems = array_filter([
                        'Admissibilite' => $service['eligibility'] ?? '',
                        'Cout' => $service['price_info'] ?? '',
                        'Contact' => $service['contact_info'] ?? '',
                    ]);

                    $buttonLabel = ($service['slug'] ?? '') === 'intervention' ? 'Nous contacter' : 'Demander ce service';
                    $placeholderPath = $servicePlaceholders[$service['slug']] ?? '';
                    ?>
                    <article class="<?= e($detailClasses); ?>" id="<?= e($service['slug']); ?>">
                        <?php if (!empty($service['image'])): ?>
                            <div class="service-detail-media">
                                <img src="<?= e(upload_url($service['image'])); ?>" alt="Photo du service <?= e($service['title']); ?>.">
                            </div>
                        <?php else: ?>
                            <div class="service-detail-media service-detail-placeholder" aria-hidden="true">
                                <span>Photo a ajouter</span>
                                <?php if ($placeholderPath): ?>
                                    <small>Chemin prevu : <?= e($placeholderPath); ?></small>
                                <?php endif; ?>
                            </div>
                        <?php endif; ?>
                        <div class="service-detail-copy">
                            <span class="eyebrow">Service <?= $index + 1; ?></span>
                            <h2><?= e($service['title']); ?></h2>
                            <p><?= e($service['full_description']); ?></p>
                            <?php if ($detailItems): ?>
                                <ul class="list-check">
                                    <?php foreach ($detailItems as $label => $value): ?>
                                        <li><strong><?= e($label); ?> :</strong> <?= e($value); ?></li>
                                    <?php endforeach; ?>
                                </ul>
                            <?php endif; ?>
                            <a class="button" href="<?= e(public_url('contact.php')); ?>"><?= e($buttonLabel); ?></a>
                        </div>
                    </article>
                <?php endforeach; ?>
            </div>
        </section>
    <?php endif; ?>

    <section class="services-steps">
        <div class="container">
            <div class="services-section-heading">
                <h2>Comment demander un service ?</h2>
            </div>
            <div class="services-steps-grid">
                <article class="service-step">
                    <span class="service-step-icon" aria-hidden="true">&#9742;</span>
                    <span class="service-step-number">1</span>
                    <h3>Communiquer avec Resolidaire</h3>
                </article>
                <article class="service-step">
                    <span class="service-step-icon" aria-hidden="true">&#9998;</span>
                    <span class="service-step-number">2</span>
                    <h3>Expliquer votre besoin</h3>
                </article>
                <article class="service-step">
                    <span class="service-step-icon" aria-hidden="true">&#10003;</span>
                    <span class="service-step-number">3</span>
                    <h3>Verifier l'admissibilite</h3>
                </article>
                <article class="service-step">
                    <span class="service-step-icon" aria-hidden="true">&#9673;</span>
                    <span class="service-step-number">4</span>
                    <h3>Confirmer le service selon les disponibilites</h3>
                </article>
            </div>
            <a class="button" href="<?= e(public_url('contact.php')); ?>">Nous contacter</a>
        </div>
    </section>

    <section class="services-conditions">
        <div class="container">
            <div class="panel services-panel">
                <h2>Conditions generales</h2>
                <p>Les services sont principalement destines aux personnes de 50 ans et plus vivant dans Hochelaga-Maisonneuve. Certaines demandes peuvent necessiter une reference d'un professionnel de la sante, d'un CLSC ou d'un organisme partenaire.</p>
            </div>
        </div>
    </section>

    <section class="services-cta">
        <div class="container">
            <div class="panel services-panel services-cta-panel">
                <h2>Besoin d'aide ou des questions ?</h2>
                <p>Notre equipe est disponible pour vous orienter vers le bon service.</p>
                <div class="quick-links">
                    <a class="button" href="<?= e($serviceRequestHref); ?>">Demander un service</a>
                    <a class="button button-secondary" href="<?= e(public_url('contact.php')); ?>">Nous contacter</a>
                </div>
            </div>
        </div>
    </section>
</main>
<?php require_once __DIR__ . '/../includes/footer.php'; ?>
