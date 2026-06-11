<?php
require_once __DIR__ . '/../app/config/config.php';

if (is_admin_logged_in()) {
    redirect(admin_url('dashboard.php'));
}

if (($_SERVER['REQUEST_METHOD'] ?? 'GET') === 'POST') {
    verify_csrf();

    $email = post_email('email');
    $password = (string) ($_POST['password'] ?? '');
    $admin = Admin::findByEmail($email);

    if ($admin && password_verify($password, $admin['password_hash'])) {
        login_admin($admin);
        set_flash('success', 'Connexion reussie.');
        redirect(admin_url('dashboard.php'));
    }

    set_flash('error', 'Identifiants invalides.');
}

$flash = get_flash();
?>
<!DOCTYPE html>
<html lang="fr-CA">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion | Admin Resolidaire</title>
    <link rel="stylesheet" href="<?= e(asset_url('css/reset.css')); ?>">
    <link rel="stylesheet" href="<?= e(asset_url('css/admin.css')); ?>">
</head>
<body class="login-page">
    <div class="login-card">
        <span class="eyebrow">Administration</span>
        <h1>Connexion</h1>
        <p>Connectez-vous pour gerer les contenus du site.</p>

        <?php if ($flash): ?>
            <div class="flash-banner flash flash-<?= e($flash['type']); ?>"><?= e($flash['message']); ?></div>
        <?php endif; ?>

        <form class="admin-form" method="post" action="">
            <?= csrf_field(); ?>
            <label>Courriel
                <input type="email" name="email" value="<?= old('email'); ?>" required>
            </label>
            <label>Mot de passe
                <input type="password" name="password" required>
            </label>
            <button type="submit">Se connecter</button>
        </form>
    </div>
</body>
</html>
