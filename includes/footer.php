<?php

$flash = get_flash();
$quickLinks = [
    ['label' => 'Demander un service', 'href' => public_url('services.php')],
    ['label' => 'Devenir benevole', 'href' => public_url('benevolat.php')],
    ['label' => 'Activites', 'href' => public_url('activites.php')],
    ['label' => 'Faire un don', 'href' => public_url('don.php')],
    ['label' => 'Contact', 'href' => public_url('contact.php')],
];

$footerIntro = html_entity_decode(
    $siteSettings['footer_intro'] ?? "R\u{00E9}solidaire soutient les a\u{00EE}n\u{00E9}s, les proches aidants et les familles du quartier.",
    ENT_QUOTES | ENT_HTML5,
    'UTF-8'
);

$footerPhone = trim((string) ($siteSettings['phone'] ?? ''));
if ($footerPhone === '' || preg_match('/^514-(?:555|000)-\d{4}$/', $footerPhone)) {
    $footerPhone = official_contact_phone_display();
}
$footerPhoneHref = official_contact_phone_href();

$footerEmail = trim((string) ($siteSettings['email'] ?? ''));
if ($footerEmail === '') {
    $footerEmail = 'info@resolidaire.org';
}

$footerAddress = trim((string) ($siteSettings['address'] ?? ''));
if (
    $footerAddress === ''
    || preg_match('/^1234(?:,\s*|\s+)rue\b/i', $footerAddress)
) {
    $footerAddress = official_contact_address();
}

$footerHours = trim((string) ($siteSettings['opening_hours'] ?? ''));
if (
    $footerHours === ''
    || preg_match('/^Lundi au vendredi,\s*9\s*h\s*[aà]\s*16\s*h$/u', $footerHours)
) {
    $footerHours = official_contact_hours_text();
}
$footerHoursLines = official_contact_hours_lines();
$footerFacebookUrl = official_facebook_url();
$footerInstagramUrl = official_instagram_url();
?>
<?php if ($flash): ?>
    <div class="flash flash-<?= e($flash['type']); ?>"><?= e($flash['message']); ?></div>
<?php endif; ?>
<footer class="site-footer">
    <div class="container site-footer-inner">
        <div class="site-footer-main">
            <section class="site-footer-brand" aria-labelledby="site-footer-brand-title">
                <a class="site-footer-logo" href="<?= e(public_url('index.php')); ?>" aria-label="Retour a l accueil de Résolidaire">
                    <img class="site-footer-logo-image" src="<?= e(asset_url('images/logo/resolidaire-logo.png')); ?>" alt="Résolidaire">
                </a>
                <h2 class="site-footer-title" id="site-footer-brand-title">Résolidaire</h2>
                <p class="site-footer-text"><?= nl2br(e($footerIntro)); ?></p>
            </section>

            <div class="site-footer-columns">
            <section class="site-footer-column" aria-labelledby="site-footer-contact-title">
                <h2 class="site-footer-title" id="site-footer-contact-title">Coordonnees</h2>
                <ul class="site-footer-list contact-list">
                    <li>
                        <i data-lucide="phone" aria-hidden="true"></i>
                        <div>
                            <strong>Telephone</strong>
                            <a class="site-footer-link" href="tel:<?= e($footerPhoneHref); ?>"><?= e($footerPhone); ?></a>
                        </div>
                    </li>
                    <li>
                        <i data-lucide="mail" aria-hidden="true"></i>
                        <div>
                            <strong>Courriel</strong>
                            <a class="site-footer-link" href="mailto:<?= e($footerEmail); ?>"><?= e($footerEmail); ?></a>
                        </div>
                    </li>
                    <li>
                        <i data-lucide="map-pin" aria-hidden="true"></i>
                        <div>
                            <strong>Adresse</strong>
                            <span><?= e($footerAddress); ?></span>
                        </div>
                    </li>
                    <li>
                        <i data-lucide="clock-3" aria-hidden="true"></i>
                        <div>
                            <strong>Heures</strong>
                            <?php foreach ($footerHoursLines as $hoursLine): ?>
                                <span><?= e($hoursLine); ?></span>
                            <?php endforeach; ?>
                        </div>
                    </li>
                </ul>
            </section>

            <nav class="site-footer-column" aria-labelledby="site-footer-links-title">
                <h2 class="site-footer-title" id="site-footer-links-title">Liens rapides</h2>
                <ul class="site-footer-list footer-links">
                    <?php foreach ($quickLinks as $link): ?>
                        <li><a class="site-footer-link" href="<?= e($link['href']); ?>"><?= e($link['label']); ?></a></li>
                    <?php endforeach; ?>
                </ul>
            </nav>

            <section class="site-footer-column" aria-labelledby="site-footer-socials-title">
                <h2 class="site-footer-title" id="site-footer-socials-title">Reseaux sociaux</h2>
                <p class="site-footer-text">Suivez Resolidaire pour rester informe des nouvelles, activites et initiatives du quartier.</p>
                <div class="site-footer-socials">
                    <a class="site-footer-social-link" href="<?= e($footerFacebookUrl); ?>" target="_blank" rel="noopener">
                        <span>Facebook</span>
                    </a>
                    <a class="site-footer-social-link" href="<?= e($footerInstagramUrl); ?>" target="_blank" rel="noopener">
                        <span>Instagram</span>
                    </a>
                </div>
            </section>
        </div>
        </div>

        <div class="site-footer-bottom">
            <p>&copy; Résolidaire</p>
            <p>Tous droits réservés.</p>
        </div>
    </div>
</footer>
<script src="<?= e(asset_url('vendor/lucide/lucide.min.js')); ?>" defer></script>
<script src="<?= e(asset_url('vendor/aos/aos.js')); ?>" defer></script>
<script src="<?= e(asset_url('vendor/gsap/gsap.min.js')); ?>" defer></script>
<script src="<?= e(asset_url('vendor/gsap/ScrollTrigger.min.js')); ?>" defer></script>
<script src="<?= e(asset_url('js/main.js')); ?>" defer></script>
<script src="<?= e(asset_url('js/animations.js')); ?>" defer></script>
</body>
</html>
