<?php

declare(strict_types=1);

class DonationCall
{
    public static function all(bool $activeOnly = false): array
    {
        $sql = 'SELECT * FROM donation_calls';
        if ($activeOnly) {
            $sql .= ' WHERE is_active = 1';
        }
        $sql .= ' ORDER BY created_at DESC';

        return db()->query($sql)->fetchAll();
    }

    public static function find(int $id): ?array
    {
        $stmt = db()->prepare('SELECT * FROM donation_calls WHERE id = :id LIMIT 1');
        $stmt->execute(['id' => $id]);
        $item = $stmt->fetch();

        return $item ?: null;
    }

    public static function create(array $data): bool
    {
        $stmt = db()->prepare('
            INSERT INTO donation_calls (title, description, button_text, button_url, image, is_active)
            VALUES (:title, :description, :button_text, :button_url, :image, :is_active)
        ');

        return $stmt->execute($data);
    }

    public static function update(int $id, array $data): bool
    {
        $data['id'] = $id;
        $stmt = db()->prepare('
            UPDATE donation_calls
            SET title = :title, description = :description, button_text = :button_text, button_url = :button_url,
                image = :image, is_active = :is_active
            WHERE id = :id
        ');

        return $stmt->execute($data);
    }

    public static function delete(int $id): bool
    {
        $stmt = db()->prepare('DELETE FROM donation_calls WHERE id = :id');
        return $stmt->execute(['id' => $id]);
    }

    public static function activeOne(): ?array
    {
        $stmt = db()->query('SELECT * FROM donation_calls WHERE is_active = 1 ORDER BY created_at DESC LIMIT 1');
        $item = $stmt->fetch();

        return $item ?: null;
    }

    public static function countActive(): int
    {
        return (int) db()->query('SELECT COUNT(*) FROM donation_calls WHERE is_active = 1')->fetchColumn();
    }
}
