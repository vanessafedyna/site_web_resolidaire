<?php
require_once __DIR__ . '/../../app/config/config.php';
require_admin();
require_post();
verify_csrf();
TeamMember::delete((int) ($_GET['id'] ?? 0));
set_flash('success', 'Membre supprime.');
redirect(admin_url('equipe/index.php'));
