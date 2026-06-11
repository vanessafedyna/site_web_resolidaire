<?php
$page_title = 'Contact';
$page_css = 'css/contact.css';
require_once __DIR__ . '/../includes/header.php';

if (($_SERVER['REQUEST_METHOD'] ?? 'GET') === 'POST') {
    verify_csrf();

    $name = post_string('name', 150);
    $email = post_email('email');
    $phone = post_string('phone', 50);
    $subject = post_string('subject', 180);
    $message = post_text('message');

    if ($name === '' || $message === '') {
        set_flash('error', 'Veuillez remplir les champs obligatoires.');
    } else {
        Message::create([
            'name' => $name,
            'email' => $email,
            'phone' => $phone,
            'subject' => $subject,
            'message' => $message,
        ]);
        set_flash('success', 'Votre message a ete envoye. Merci.');
        redirect(public_url('contact.php'));
    }
}

require_once __DIR__ . '/../includes/nav.php';

$contactPhoneDisplay = '514-598-9670';
$contactPhoneHref = '5145989670';
$contactEmail = 'info@resolidaire.org';
$contactAddress = '2502 Av. Desjardins, Montreal';
$contactHours = [
    'Lundi au jeudi : 8 h 30 a 12 h 30 et 13 h a 16 h 30',
    'Vendredi : 8 h 30 a 13 h 30',
];
$contactNeeds = [
    [
        'title' => 'Demander un service',
        'text' => 'Pour obtenir de l aide, verifier l admissibilite ou poser une question sur les services.',
    ],
    [
        'title' => 'Devenir benevole',
        'text' => 'Pour offrir du temps, participer aux activites ou soutenir l equipe.',
    ],
    [
        'title' => 'Faire un don',
        'text' => 'Pour contribuer a la mission et soutenir les actions locales.',
    ],
    [
        'title' => 'Information generale',
        'text' => 'Pour toute autre question concernant l organisme.',
    ],
];
?>
<main id="main-content">
    <section class="page-hero">
        <div class="container">
            <div class="panel">
                <span class="eyebrow">Contact</span>
                <h1>Nous joindre facilement.</h1>
                <p>Vous avez une question, un besoin ou une demande de suivi ? Ecrivez-nous et notre equipe reviendra vers vous.</p>
            </div>
        </div>
    </section>

    <section class="contact-layout">
        <div class="container split-grid">
            <div class="contact-card contact-info-card">
                <h2>Coordonnees</h2>
                <div class="contact-info-list">
                    <div class="contact-info-item">
                        <h3>Telephone</h3>
                        <p><a href="tel:<?= e($contactPhoneHref); ?>"><?= e($contactPhoneDisplay); ?></a></p>
                    </div>
                    <div class="contact-info-item">
                        <h3>Courriel</h3>
                        <p><a href="mailto:<?= e($contactEmail); ?>"><?= e($contactEmail); ?></a></p>
                    </div>
                    <div class="contact-info-item">
                        <h3>Adresse</h3>
                        <p><?= e($contactAddress); ?></p>
                    </div>
                    <div class="contact-info-item">
                        <h3>Heures d ouverture</h3>
                        <?php foreach ($contactHours as $hoursLine): ?>
                            <p><?= e($hoursLine); ?></p>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>

            <div class="contact-card">
                <h2>Envoyer un message</h2>
                <form class="contact-form" method="post" action="">
                    <?= csrf_field(); ?>
                    <label for="contact-name">Nom complet *
                        <input id="contact-name" type="text" name="name" value="<?= old('name'); ?>" required>
                    </label>
                    <label for="contact-email">Courriel
                        <input id="contact-email" type="email" name="email" value="<?= old('email'); ?>">
                    </label>
                    <label for="contact-phone">Telephone
                        <input id="contact-phone" type="text" name="phone" value="<?= old('phone'); ?>">
                    </label>
                    <label for="contact-subject">Sujet
                        <input id="contact-subject" type="text" name="subject" value="<?= old('subject'); ?>">
                    </label>
                    <label for="contact-message">Message *
                        <textarea id="contact-message" name="message" required><?= old('message'); ?></textarea>
                    </label>
                    <button type="submit">Envoyer</button>
                </form>
            </div>
        </div>
    </section>

    <section class="contact-needs">
        <div class="container">
            <div class="contact-section-heading">
                <h2>Pour quel besoin nous contacter ?</h2>
            </div>
            <div class="contact-needs-grid">
                <?php foreach ($contactNeeds as $need): ?>
                    <article class="contact-card contact-need-card">
                        <span class="contact-dot" aria-hidden="true"></span>
                        <h3><?= e($need['title']); ?></h3>
                        <p><?= e($need['text']); ?></p>
                    </article>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <section class="contact-location">
        <div class="container">
            <div class="contact-card contact-location-card">
                <h2>Nous trouver</h2>
                <p>Resolidaire est situe au 2502 Av. Desjardins, Montreal.</p>
                <a class="button button-secondary" href="https://www.google.com/maps/search/?api=1&query=2502%20Ave.%20Desjardins%2C%20Montreal" target="_blank" rel="noopener">Voir l itineraire</a>
            </div>
        </div>
    </section>

    <section class="contact-cta">
        <div class="container">
            <div class="panel contact-cta-panel">
                <h2>Besoin d aide pour choisir le bon service ?</h2>
                <p>Communiquez avec nous et nous vous orienterons vers la bonne ressource.</p>
                <div class="quick-links">
                    <a class="button" href="tel:<?= e($contactPhoneHref); ?>">Nous appeler</a>
                    <a class="button button-secondary" href="mailto:<?= e($contactEmail); ?>">Nous ecrire</a>
                </div>
            </div>
        </div>
    </section>
</main>
<?php require_once __DIR__ . '/../includes/footer.php'; ?>
