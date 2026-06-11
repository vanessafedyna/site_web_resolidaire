<?php
require_once __DIR__ . '/../../app/config/config.php';
require_admin();
require_post();
verify_csrf();
DonationCall::delete((int) ($_GET['id'] ?? 0));
set_flash('success', 'Appel aux dons supprime.');
redirect(admin_url('dons/index.php'));
