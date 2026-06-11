<?php

$flash = get_flash();
$quickLinks = [
    ['label' => 'Demander un service', 'href' => public_url('services.php')],
    ['label' => 'Devenir benevole', 'href' => public_url('benevolat.php')],
    ['label' => 'Nous contacter', 'href' => public_url('contact.php')],
    ['label' => 'Faire un don', 'href' => public_url('don.php')],
];

/* FOOTER ENCODING FIX */
$footerIntro = html_entity_decode(
    $siteSettings['footer_intro'] ?? "Résolidaire soutient les aînés, les proches aidants et les familles du quartier.",
    ENT_QUOTES | ENT_HTML5,
    'UTF-8'
);
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
                <li><strong>Telephone :</strong> <?= e($siteSettings['phone'] ?? '514-000-0000'); ?></li>
                <li><strong>Courriel :</strong> <a href="mailto:<?= e($siteSettings['email'] ?? 'info@resolidaire.org'); ?>"><?= e($siteSettings['email'] ?? 'info@resolidaire.org'); ?></a></li>
                <li><strong>Adresse :</strong> <?= e($siteSettings['address'] ?? 'Montreal, QC'); ?></li>
                <li><strong>Heures :</strong> <?= e($siteSettings['opening_hours'] ?? 'Lundi au vendredi, 9 h a 16 h'); ?></li>
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
            <h2>Suivre Resolidaire</h2>
            <p>Restez proche de la vie de quartier, des activites et des appels a l'entraide.</p>
            <a class="button button-secondary" href="<?= e($siteSettings['facebook_url'] ?? '#'); ?>" target="_blank" rel="noopener">Facebook</a>
        </section>
    </div>
</footer>
<script src="<?= e(asset_url('js/main.js')); ?>" defer></script>
</body>
</html>
