<?php

$mainMenu = [
    'index.php' => 'Accueil',
    'a-propos.php' => 'A propos',
    'services.php' => 'Services',
    'activites.php' => 'Activites',
    'benevolat.php' => 'Benevolat',
    'don.php' => 'Faire un don',
    'contact.php' => 'Contact',
];
?>
<header class="site-header">
    <div class="container header-row">
        <a class="brand" href="<?= e(public_url('index.php')); ?>">
            <img class="brand-logo" src="<?= e(asset_url('images/logo/resolidaire-logo.png')); ?>" alt="Logo Resolidaire">
            <span class="brand-copy">
                <small>Organisme communautaire de proximit&#233;</small>
            </span>
        </a>

        <button class="menu-toggle" type="button" aria-expanded="false" aria-controls="main-nav">
            Menu
        </button>

        <nav id="main-nav" class="main-nav" aria-label="Navigation principale">
            <ul>
                <?php foreach ($mainMenu as $file => $label): ?>
                    <li><a href="<?= e(public_url($file)); ?>"<?= is_current_page($file) ? ' aria-current="page"' : ''; ?>><?= e($label); ?></a></li>
                <?php endforeach; ?>
            </ul>
        </nav>
    </div>
</header>
