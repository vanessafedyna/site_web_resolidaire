<?php
$page_title = 'Services';
$page_css = 'css/services.css';
require_once __DIR__ . '/../includes/header.php';
require_once __DIR__ . '/../includes/nav.php';
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
            <div class="services-cards-grid">
                <article class="service-card">
                    <a class="service-card-link" href="#popote">
                        <h2>Popote roulante</h2>
                        <p>Livraison de repas chauds a domicile pour soutenir l'autonomie et le maintien a domicile.</p>
                        <span class="button button-secondary">En savoir plus</span>
                    </a>
                </article>
                <article class="service-card">
                    <a class="service-card-link" href="#transport-medical">
                        <h2>Accompagnement et transport medical</h2>
                        <p>Accompagnement benevole vers les rendez-vous medicaux, selon les disponibilites.</p>
                        <span class="button button-secondary">En savoir plus</span>
                    </a>
                </article>
                <article class="service-card">
                    <a class="service-card-link" href="#epicerie">
                        <h2>Transport vers l'epicerie</h2>
                        <p>Transport organise vers certains points d'alimentation du quartier.</p>
                        <span class="button button-secondary">En savoir plus</span>
                    </a>
                </article>
                <article class="service-card">
                    <a class="service-card-link" href="#intervention">
                        <h2>Intervention de milieu</h2>
                        <p>Ecoute, orientation, accompagnement et presence de proximite dans le quartier.</p>
                        <span class="button button-secondary">En savoir plus</span>
                    </a>
                </article>
            </div>
        </div>
    </section>

    <section class="services-detail-list">
        <div class="container services-detail-stack">
            <article class="service-detail" id="popote">
                <div class="service-detail-media">
                    <img src="<?= e(asset_url('images/services/popote-roulante.png')); ?>" alt="Benevole de Resolidaire devant une voiture de service pour la popote roulante.">
                </div>
                <div class="service-detail-copy">
                    <span class="eyebrow">Service 1</span>
                    <h2>Popote roulante</h2>
                    <p>La popote roulante permet de recevoir des repas chauds a domicile. Ce service s'adresse aux personnes ainees ou en perte d'autonomie, de facon temporaire ou permanente.</p>
                    <ul class="list-check">
                        <li>Repas livres a domicile</li>
                        <li>Soutien au maintien a domicile</li>
                        <li>Service offert selon l'admissibilite</li>
                        <li>Cout indicatif : 6 $ par repas, incluant soupe et dessert</li>
                    </ul>
                    <a class="button" href="<?= e(public_url('contact.php')); ?>">Demander ce service</a>
                </div>
            </article>

            <article class="service-detail service-detail-reverse" id="transport-medical">
                <div class="service-detail-media service-detail-placeholder" aria-hidden="true">
                    <span>Photo a ajouter</span>
                    <small>Chemin prevu : assets/images/services/transport-medical.jpg</small>
                </div>
                <div class="service-detail-copy">
                    <span class="eyebrow">Service 2</span>
                    <h2>Accompagnement et transport medical</h2>
                    <p>Ce service aide les beneficiaires a se rendre a leurs rendez-vous medicaux grace a l'accompagnement de benevoles.</p>
                    <ul class="list-check">
                        <li>Transport vers un rendez-vous medical</li>
                        <li>Presence rassurante d'un benevole</li>
                        <li>Service offert selon les disponibilites</li>
                        <li>Cout du trajet calcule selon la distance</li>
                    </ul>
                    <a class="button" href="<?= e(public_url('contact.php')); ?>">Demander ce service</a>
                </div>
            </article>

            <article class="service-detail" id="epicerie">
                <div class="service-detail-media service-detail-placeholder" aria-hidden="true">
                    <span>Photo a ajouter</span>
                    <small>Chemin prevu : assets/images/services/transport-epicerie.jpg</small>
                </div>
                <div class="service-detail-copy">
                    <span class="eyebrow">Service 3</span>
                    <h2>Transport vers l'epicerie</h2>
                    <p>Ce service permet a des personnes accompagnees de se rendre a l'epicerie a certains moments determines.</p>
                    <ul class="list-check">
                        <li>Transport vers des points d'alimentation du quartier</li>
                        <li>Service collectif</li>
                        <li>Reservation requise</li>
                        <li>Horaire selon les disponibilites</li>
                    </ul>
                    <a class="button" href="<?= e(public_url('contact.php')); ?>">Demander ce service</a>
                </div>
            </article>

            <article class="service-detail service-detail-reverse" id="intervention">
                <div class="service-detail-media service-detail-placeholder" aria-hidden="true">
                    <span>Photo a ajouter</span>
                    <small>Chemin prevu : assets/images/services/intervention-milieu.jpg</small>
                </div>
                <div class="service-detail-copy">
                    <span class="eyebrow">Service 4</span>
                    <h2>Intervention de milieu</h2>
                    <p>L'intervention de milieu permet d'offrir une presence de proximite, de l'ecoute, de l'orientation et du soutien aux personnes du quartier.</p>
                    <ul class="list-check">
                        <li>Ecoute et accompagnement</li>
                        <li>Orientation vers les bons services</li>
                        <li>Soutien aux proches aidants</li>
                        <li>Presence humaine dans le milieu de vie</li>
                    </ul>
                    <a class="button" href="<?= e(public_url('contact.php')); ?>">Nous contacter</a>
                </div>
            </article>
        </div>
    </section>

    <section class="services-steps">
        <div class="container">
            <div class="services-section-heading">
                <h2>Comment demander un service ?</h2>
            </div>
            <div class="services-steps-grid">
                <article class="service-step">
                    <span class="service-step-icon" aria-hidden="true">☎</span>
                    <span class="service-step-number">1</span>
                    <h3>Communiquer avec Resolidaire</h3>
                </article>
                <article class="service-step">
                    <span class="service-step-icon" aria-hidden="true">✎</span>
                    <span class="service-step-number">2</span>
                    <h3>Expliquer votre besoin</h3>
                </article>
                <article class="service-step">
                    <span class="service-step-icon" aria-hidden="true">✓</span>
                    <span class="service-step-number">3</span>
                    <h3>Verifier l'admissibilite</h3>
                </article>
                <article class="service-step">
                    <span class="service-step-icon" aria-hidden="true">◎</span>
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
                    <a class="button" href="#popote">Demander un service</a>
                    <a class="button button-secondary" href="<?= e(public_url('contact.php')); ?>">Nous contacter</a>
                </div>
            </div>
        </div>
    </section>
</main>
<?php require_once __DIR__ . '/../includes/footer.php'; ?>
