<?php
require_once __DIR__ . '/../../app/config/config.php';
require_admin();
require_post();
verify_csrf();
Partner::delete((int) ($_GET['id'] ?? 0));
set_flash('success', 'Partenaire supprime.');
redirect(admin_url('partenaires/index.php'));
