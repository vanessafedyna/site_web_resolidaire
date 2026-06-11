<?php
$page_title = 'Parametres du site';
require_once __DIR__ . '/../../includes/admin-header.php';

$fields = [
    'phone' => 'Telephone',
    'email' => 'Courriel',
    'address' => 'Adresse',
    'opening_hours' => 'Heures d\'ouverture',
    'facebook_url' => 'Lien Facebook',
    'donation_url' => 'Lien de don externe',
    'footer_intro' => 'Texte court du footer',
];

if (($_SERVER['REQUEST_METHOD'] ?? 'GET') === 'POST') {
    verify_csrf();
    $payload = [];
    foreach (array_keys($fields) as $key) {
        $payload[$key] = trim((string) ($_POST[$key] ?? ''));
    }
    SiteSetting::upsertMany($payload);
    set_flash('success', 'Parametres mis a jour.');
    redirect(admin_url('settings/index.php'));
}

$settings = SiteSetting::all();
?>
<?php require_once __DIR__ . '/../../includes/admin-sidebar.php'; ?>
<main class="admin-main">
    <div class="admin-topbar"><h1>Parametres du site</h1></div>
    <?php if ($adminFlash): ?><div class="flash-banner flash flash-<?= e($adminFlash['type']); ?>"><?= e($adminFlash['message']); ?></div><?php endif; ?>
    <section class="form-card">
        <form class="admin-form" method="post">
            <?= csrf_field(); ?>
            <?php foreach ($fields as $key => $label): ?>
                <label><?= e($label); ?>
                    <?php if (in_array($key, ['address', 'opening_hours', 'footer_intro'], true)): ?>
                        <textarea name="<?= e($key); ?>"><?= e($settings[$key] ?? ''); ?></textarea>
                    <?php else: ?>
                        <input type="text" name="<?= e($key); ?>" value="<?= e($settings[$key] ?? ''); ?>">
                    <?php endif; ?>
                </label>
            <?php endforeach; ?>
            <button type="submit">Enregistrer les parametres</button>
        </form>
    </section>
</main>
<?php require_once __DIR__ . '/../../includes/admin-footer.php'; ?>
