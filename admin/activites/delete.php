<?php
require_once __DIR__ . '/../../app/config/config.php';
require_admin();
require_post();
verify_csrf();
Activity::delete((int) ($_GET['id'] ?? 0));
set_flash('success', 'Activite supprimee.');
redirect(admin_url('activites/index.php'));
