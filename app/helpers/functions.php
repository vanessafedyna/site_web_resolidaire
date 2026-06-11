<?php

declare(strict_types=1);

function e(?string $value): string
{
    return htmlspecialchars((string) $value, ENT_QUOTES, 'UTF-8');
}

function root_url(string $path = ''): string
{
    $scriptName = str_replace('\\', '/', $_SERVER['SCRIPT_NAME'] ?? '');

    if (strpos($scriptName, '/public/') !== false) {
        $base = preg_replace('#/public/.*$#', '', $scriptName) ?: '';
        return rtrim($base, '/') . '/' . ltrim($path, '/');
    }

    if (preg_match('#/admin/.*$#', $scriptName)) {
        $base = preg_replace('#/admin/.*$#', '', $scriptName) ?: '';
        return rtrim($base, '/') . '/' . ltrim($path, '/');
    }

    return '/' . ltrim($path, '/');
}

function public_url(string $path = ''): string
{
    $scriptName = str_replace('\\', '/', $_SERVER['SCRIPT_NAME'] ?? '');

    if (strpos($scriptName, '/public/') !== false) {
        $base = preg_replace('#/public/.*$#', '/public', $scriptName) ?: '/public';
        return rtrim($base, '/') . '/' . ltrim($path, '/');
    }

    if (preg_match('#/admin/.*$#', $scriptName)) {
        $base = preg_replace('#/admin/.*$#', '/public', $scriptName) ?: '/public';
        return rtrim($base, '/') . '/' . ltrim($path, '/');
    }

    return '/' . ltrim($path, '/');
}

function admin_url(string $path = ''): string
{
    return rtrim(root_url('admin'), '/') . '/' . ltrim($path, '/');
}

function asset_url(string $path): string
{
    $scriptName = str_replace('\\', '/', $_SERVER['SCRIPT_NAME'] ?? '');

    if (strpos($scriptName, '/public/') !== false) {
        $base = preg_replace('#/public/.*$#', '', $scriptName) ?: '';
        return rtrim($base, '/') . '/assets/' . ltrim($path, '/');
    }

    if (preg_match('#/admin/.*$#', $scriptName)) {
        $base = preg_replace('#/admin/.*$#', '', $scriptName) ?: '';
        return rtrim($base, '/') . '/assets/' . ltrim($path, '/');
    }

    return '/assets/' . ltrim($path, '/');
}

function upload_url(?string $path): string
{
    if (!$path) {
        return asset_url('images/placeholders/default-card.svg');
    }

    return asset_url('uploads/' . ltrim($path, '/'));
}

function redirect(string $url): void
{
    header('Location: ' . $url);
    exit;
}

function set_flash(string $type, string $message): void
{
    $_SESSION['flash'] = ['type' => $type, 'message' => $message];
}

function get_flash(): ?array
{
    if (!isset($_SESSION['flash'])) {
        return null;
    }

    $flash = $_SESSION['flash'];
    unset($_SESSION['flash']);

    return $flash;
}

function old(string $key, string $default = ''): string
{
    return e($_POST[$key] ?? $default);
}

function current_path(): string
{
    return basename(parse_url($_SERVER['REQUEST_URI'] ?? '', PHP_URL_PATH) ?: '');
}

function is_current_page(string $filename): bool
{
    return current_path() === $filename;
}

function format_date(?string $date, string $format = 'd/m/Y'): string
{
    if (!$date) {
        return '';
    }

    $timestamp = strtotime($date);
    return $timestamp ? date($format, $timestamp) : '';
}

function format_datetime(?string $date, ?string $timeStart = null, ?string $timeEnd = null): string
{
    if (!$date) {
        return '';
    }

    $parts = [format_date($date)];

    if ($timeStart) {
        $parts[] = substr($timeStart, 0, 5);
    }

    if ($timeEnd) {
        $parts[] = 'a ' . substr($timeEnd, 0, 5);
    }

    return implode(' ', $parts);
}
