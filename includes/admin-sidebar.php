<aside class="admin-sidebar">
    <a class="admin-brand" href="<?= e(admin_url('dashboard.php')); ?>">
        <img class="brand-logo brand-logo-admin" src="<?= e(asset_url('images/logo/resolidaire-logo.png')); ?>" alt="Logo Resolidaire">
        <span>Admin Resolidaire</span>
    </a>

    <nav aria-label="Navigation d'administration">
        <ul>
            <li><a href="<?= e(admin_url('dashboard.php')); ?>">Tableau de bord</a></li>
            <li><a href="<?= e(admin_url('equipe/index.php')); ?>">Equipe</a></li>
            <li><a href="<?= e(admin_url('activites/index.php')); ?>">Activites</a></li>
            <li><a href="<?= e(admin_url('services/index.php')); ?>">Services</a></li>
            <li><a href="<?= e(admin_url('dons/index.php')); ?>">Appels aux dons</a></li>
            <li><a href="<?= e(admin_url('partenaires/index.php')); ?>">Partenaires</a></li>
            <li><a href="<?= e(admin_url('messages/index.php')); ?>">Messages</a></li>
            <li><a href="<?= e(admin_url('settings/index.php')); ?>">Parametres</a></li>
            <li><a href="<?= e(admin_url('logout.php')); ?>">Deconnexion</a></li>
        </ul>
    </nav>
</aside>
