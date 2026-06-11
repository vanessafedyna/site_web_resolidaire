<?php

declare(strict_types=1);

class Message
{
    public static function all(): array
    {
        return db()->query('SELECT * FROM messages ORDER BY created_at DESC')->fetchAll();
    }

    public static function find(int $id): ?array
    {
        $stmt = db()->prepare('SELECT * FROM messages WHERE id = :id LIMIT 1');
        $stmt->execute(['id' => $id]);
        $item = $stmt->fetch();

        return $item ?: null;
    }

    public static function create(array $data): bool
    {
        $stmt = db()->prepare('
            INSERT INTO messages (name, email, phone, subject, message)
            VALUES (:name, :email, :phone, :subject, :message)
        ');

        return $stmt->execute($data);
    }

    public static function markAsRead(int $id): bool
    {
        $stmt = db()->prepare('UPDATE messages SET is_read = 1 WHERE id = :id');
        return $stmt->execute(['id' => $id]);
    }

    public static function delete(int $id): bool
    {
        $stmt = db()->prepare('DELETE FROM messages WHERE id = :id');
        return $stmt->execute(['id' => $id]);
    }

    public static function countUnread(): int
    {
        return (int) db()->query('SELECT COUNT(*) FROM messages WHERE is_read = 0')->fetchColumn();
    }
}
