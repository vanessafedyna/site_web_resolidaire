<?php

declare(strict_types=1);

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

define('ROOT_PATH', dirname(__DIR__, 2));
define('APP_PATH', ROOT_PATH . '/app');
define('INCLUDES_PATH', ROOT_PATH . '/includes');
define('ASSETS_PATH', ROOT_PATH . '/assets');
define('PUBLIC_MIRROR_ASSETS_PATH', ROOT_PATH . '/public/assets');
define('UPLOADS_PATH', ASSETS_PATH . '/uploads');

define('APP_ENV', 'production');

if (APP_ENV === 'production') {
    ini_set('display_errors', '0');
    error_reporting(E_ALL);
} else {
    ini_set('display_errors', '1');
    error_reporting(E_ALL);
}

require_once APP_PATH . '/config/database.php';
require_once APP_PATH . '/helpers/functions.php';
require_once APP_PATH . '/helpers/security.php';
require_once APP_PATH . '/helpers/csrf.php';
require_once APP_PATH . '/helpers/auth.php';
require_once APP_PATH . '/helpers/upload.php';

require_once APP_PATH . '/models/Admin.php';
require_once APP_PATH . '/models/TeamMember.php';
require_once APP_PATH . '/models/Activity.php';
require_once APP_PATH . '/models/Service.php';
require_once APP_PATH . '/models/DonationCall.php';
require_once APP_PATH . '/models/Partner.php';
require_once APP_PATH . '/models/Message.php';
require_once APP_PATH . '/models/SiteSetting.php';
