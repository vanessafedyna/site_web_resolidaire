<?php

declare(strict_types=1);

require_once __DIR__ . '/../app/config/config.php';
require_admin();
$adminFlash = get_flash();
$adminUser = current_admin();
?>
<!DOCTYPE html>
<html lang="fr-CA">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= e($page_title ?? 'Administration'); ?> | Admin Resolidaire</title>
    <link rel="stylesheet" href="<?= e(asset_url('css/reset.css')); ?>">
    <link rel="stylesheet" href="<?= e(asset_url('css/admin.css')); ?>">
</head>
<body class="admin-body">
<div class="admin-layout">
