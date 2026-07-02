<?php

$flash = get_flash();
$quickLinks = [
    ['label' => 'Demander un service', 'href' => public_url('services.php')],
    ['label' => 'Devenir benevole', 'href' => public_url('benevolat.php')],
    ['label' => 'Nous contacter', 'href' => public_url('contact.php')],
    ['label' => 'Faire un don', 'href' => public_url('don.php')],
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
$footerFacebookUrl = 'https://www.facebook.com/Resolidaire.inc/';
$footerInstagramUrl = 'https://www.instagram.com/resolidaire/';
?>
<?php if ($flash): ?>
    <div class="flash flash-<?= e($flash['type']); ?>"><?= e($flash['message']); ?></div>
<?php endif; ?>
<footer class="site-footer">
    <div class="container footer-grid">
        <section>
            <h2>Coordonnees</h2>
            <p><?= nl2br(e($footerIntro)); ?></p>
            <ul class="contact-list">
                <li><strong>Telephone :</strong> <?= e($footerPhone); ?></li>
                <li><strong>Courriel :</strong> <a href="mailto:<?= e($siteSettings['email'] ?? 'info@resolidaire.org'); ?>"><?= e($siteSettings['email'] ?? 'info@resolidaire.org'); ?></a></li>
                <li><strong>Adresse :</strong> <?= e($footerAddress); ?></li>
                <li><strong>Heures :</strong> <?= e($footerHours); ?></li>
            </ul>
        </section>

        <section>
            <h2>Liens rapides</h2>
            <ul class="footer-links">
                <?php foreach ($quickLinks as $link): ?>
                    <li><a href="<?= e($link['href']); ?>"><?= e($link['label']); ?></a></li>
                <?php endforeach; ?>
            </ul>
        </section>

        <section>
            <h2>Suivez-nous</h2>
            <p>Retrouvez Resolidaire sur les reseaux sociaux.</p>
            <div class="quick-links">
                <a class="button button-secondary" href="<?= e($footerFacebookUrl); ?>" target="_blank" rel="noopener" style="color: #f5f2e8; border-color: #f5f2e8;">Facebook</a>
                <a class="button button-secondary" href="<?= e($footerInstagramUrl); ?>" target="_blank" rel="noopener" style="color: #f5f2e8; border-color: #f5f2e8;">Instagram</a>
            </div>
        </section>
    </div>
</footer>
<script src="<?= e(asset_url('vendor/lucide/lucide.min.js')); ?>" defer></script>
<script src="<?= e(asset_url('vendor/aos/aos.js')); ?>" defer></script>
<script src="<?= e(asset_url('js/main.js')); ?>" defer></script>
</body>
</html>
