<?php

declare(strict_types=1);

class Partner
{
    public static function all(bool $activeOnly = false): array
    {
        $sql = 'SELECT * FROM partners';
        if ($activeOnly) {
            $sql .= ' WHERE is_active = 1';
        }
        $sql .= ' ORDER BY display_order ASC, name ASC';

        return db()->query($sql)->fetchAll();
    }

    public static function find(int $id): ?array
    {
        $stmt = db()->prepare('SELECT * FROM partners WHERE id = :id LIMIT 1');
        $stmt->execute(['id' => $id]);
        $item = $stmt->fetch();

        return $item ?: null;
    }

    public static function create(array $data): bool
    {
        $stmt = db()->prepare('
            INSERT INTO partners (name, description, logo, website_url, display_order, is_active)
            VALUES (:name, :description, :logo, :website_url, :display_order, :is_active)
        ');

        return $stmt->execute($data);
    }

    public static function update(int $id, array $data): bool
    {
        $data['id'] = $id;
        $stmt = db()->prepare('
            UPDATE partners
            SET name = :name, description = :description, logo = :logo, website_url = :website_url,
                display_order = :display_order, is_active = :is_active
            WHERE id = :id
        ');

        return $stmt->execute($data);
    }

    public static function delete(int $id): bool
    {
        $stmt = db()->prepare('DELETE FROM partners WHERE id = :id');
        return $stmt->execute(['id' => $id]);
    }

    public static function countActive(): int
    {
        return (int) db()->query('SELECT COUNT(*) FROM partners WHERE is_active = 1')->fetchColumn();
    }
}
