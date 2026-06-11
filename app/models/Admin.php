<?php

declare(strict_types=1);

class Admin
{
    public static function findByEmail(string $email): ?array
    {
        $stmt = db()->prepare('SELECT * FROM admins WHERE email = :email LIMIT 1');
        $stmt->execute(['email' => $email]);
        $admin = $stmt->fetch();

        return $admin ?: null;
    }

    public static function countAll(): int
    {
        return (int) db()->query('SELECT COUNT(*) FROM admins')->fetchColumn();
    }
}
