<?php

declare(strict_types=1);

class Service
{
    public static function all(bool $activeOnly = false): array
    {
        $sql = 'SELECT * FROM services';
        if ($activeOnly) {
            $sql .= ' WHERE is_active = 1';
        }
        $sql .= ' ORDER BY display_order ASC, title ASC';

        return db()->query($sql)->fetchAll();
    }

    public static function featured(int $limit = 4): array
    {
        $stmt = db()->prepare('SELECT * FROM services WHERE is_active = 1 ORDER BY display_order ASC LIMIT :service_limit');
        $stmt->bindValue(':service_limit', $limit, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll();
    }

    public static function find(int $id): ?array
    {
        $stmt = db()->prepare('SELECT * FROM services WHERE id = :id LIMIT 1');
        $stmt->execute(['id' => $id]);
        $item = $stmt->fetch();

        return $item ?: null;
    }

    public static function update(int $id, array $data): bool
    {
        $data['id'] = $id;
        $stmt = db()->prepare('
            UPDATE services
            SET title = :title, slug = :slug, short_description = :short_description, full_description = :full_description,
                eligibility = :eligibility, price_info = :price_info, contact_info = :contact_info, image = :image,
                display_order = :display_order, is_active = :is_active
            WHERE id = :id
        ');

        return $stmt->execute($data);
    }

    public static function countActive(): int
    {
        return (int) db()->query('SELECT COUNT(*) FROM services WHERE is_active = 1')->fetchColumn();
    }
}
