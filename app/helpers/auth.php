<?php

declare(strict_types=1);

function login_admin(array $admin): void
{
    $_SESSION['admin_id'] = (int) $admin['id'];
    $_SESSION['admin_name'] = $admin['name'];
    $_SESSION['admin_role'] = $admin['role'];
}

function logout_admin(): void
{
    $_SESSION = [];

    if (ini_get('session.use_cookies')) {
        $params = session_get_cookie_params();
        setcookie(session_name(), '', time() - 42000, $params['path'], $params['domain'], (bool) $params['secure'], (bool) $params['httponly']);
    }

    session_destroy();
}

function is_admin_logged_in(): bool
{
    return !empty($_SESSION['admin_id']);
}

function require_admin(): void
{
    if (!is_admin_logged_in()) {
        set_flash('error', 'Veuillez vous connecter pour acceder a l\'administration.');
        redirect(admin_url('login.php'));
    }
}

function current_admin(): ?array
{
    if (!is_admin_logged_in()) {
        return null;
    }

    return [
        'id' => (int) $_SESSION['admin_id'],
        'name' => $_SESSION['admin_name'] ?? '',
        'role' => $_SESSION['admin_role'] ?? 'editor',
    ];
}
