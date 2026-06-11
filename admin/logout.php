<?php
require_once __DIR__ . '/../app/config/config.php';
logout_admin();
set_flash('success', 'Vous avez ete deconnectee.');
redirect(admin_url('login.php'));
