<?php

declare(strict_types=1);

require_once __DIR__ . '/../app/config/config.php';

$siteSettings = SiteSetting::all();
$pageTitle = $page_title ?? 'Resolidaire';
?>
<!DOCTYPE html>
<html lang="fr-CA">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= e($pageTitle); ?> | R&#233;solidaire</title>
    <meta name="description" content="R&#233;solidaire accompagne les a&#238;n&#233;s, les proches aidants et la communaut&#233; avec des services humains et accessibles.">
    <link rel="stylesheet" href="<?= e(asset_url('css/reset.css')); ?>">
    <link rel="stylesheet" href="<?= e(asset_url('css/style.css')); ?>">
    <link rel="stylesheet" href="<?= e(asset_url('css/responsive.css')); ?>">
    <?php if (!empty($page_css ?? null)): ?>
        <link rel="stylesheet" href="<?= e(asset_url($page_css)); ?>">
    <?php endif; ?>
</head>
<body>
<a class="skip-link" href="#main-content">Aller au contenu</a>
