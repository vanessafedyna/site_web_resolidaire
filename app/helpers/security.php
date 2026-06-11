<?php

declare(strict_types=1);

function post_string(string $key, int $maxLength = 255): string
{
    $value = trim((string) ($_POST[$key] ?? ''));
    return mb_substr($value, 0, $maxLength);
}

function post_text(string $key): string
{
    return trim((string) ($_POST[$key] ?? ''));
}

function post_int(string $key, int $default = 0): int
{
    return filter_var($_POST[$key] ?? $default, FILTER_VALIDATE_INT) !== false
        ? (int) $_POST[$key]
        : $default;
}

function post_bool(string $key): int
{
    return isset($_POST[$key]) ? 1 : 0;
}

function post_email(string $key): string
{
    $value = trim((string) ($_POST[$key] ?? ''));
    return filter_var($value, FILTER_VALIDATE_EMAIL) ? $value : '';
}

function post_url(string $key): string
{
    $value = trim((string) ($_POST[$key] ?? ''));
    return $value !== '' && filter_var($value, FILTER_VALIDATE_URL) ? $value : '';
}

function require_post(): void
{
    if (($_SERVER['REQUEST_METHOD'] ?? 'GET') !== 'POST') {
        http_response_code(405);
        exit('Methode non autorisee.');
    }
}
