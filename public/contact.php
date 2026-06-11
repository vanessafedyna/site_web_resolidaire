<?php
$page_title = 'Contact';
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
?>
<main id="main-content">
    <section class="page-hero">
        <div class="container">
            <div class="panel">
                <span class="eyebrow">Contact</span>
                <h1>Nous joindre facilement.</h1>
                <p>Vous avez une question, un besoin ou une demande de suivi? Ecrivez-nous et notre equipe reviendra vers vous.</p>
            </div>
        </div>
    </section>
    <section>
        <div class="container split-grid">
            <div class="contact-card">
                <h2>Coordonnees</h2>
                <p><strong>Telephone :</strong> <?= e($siteSettings['phone'] ?? '514-000-0000'); ?></p>
                <p><strong>Courriel :</strong> <?= e($siteSettings['email'] ?? 'info@resolidaire.org'); ?></p>
                <p><strong>Adresse :</strong> <?= e($siteSettings['address'] ?? 'Montreal, QC'); ?></p>
                <p><strong>Heures :</strong> <?= e($siteSettings['opening_hours'] ?? 'Lundi au vendredi, 9 h a 16 h'); ?></p>
            </div>
            <div class="contact-card">
                <h2>Envoyer un message</h2>
                <form class="contact-form" method="post" action="">
                    <?= csrf_field(); ?>
                    <label>Nom complet *
                        <input type="text" name="name" value="<?= old('name'); ?>" required>
                    </label>
                    <label>Courriel
                        <input type="email" name="email" value="<?= old('email'); ?>">
                    </label>
                    <label>Telephone
                        <input type="text" name="phone" value="<?= old('phone'); ?>">
                    </label>
                    <label>Sujet
                        <input type="text" name="subject" value="<?= old('subject'); ?>">
                    </label>
                    <label>Message *
                        <textarea name="message" required><?= old('message'); ?></textarea>
                    </label>
                    <button type="submit">Envoyer</button>
                </form>
            </div>
        </div>
    </section>
</main>
<?php require_once __DIR__ . '/../includes/footer.php'; ?>
