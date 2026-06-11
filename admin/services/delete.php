<?php
require_once __DIR__ . '/../../app/config/config.php';
require_admin();
require_post();
verify_csrf();
Service::delete((int) ($_GET['id'] ?? 0));
set_flash('success', 'Service supprime.');
redirect(admin_url('services/index.php'));
