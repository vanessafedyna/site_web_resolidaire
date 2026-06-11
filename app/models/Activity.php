<?php

declare(strict_types=1);

class Activity
{
    public static function all(bool $publishedOnly = false): array
    {
        $sql = 'SELECT * FROM activities';
        if ($publishedOnly) {
            $sql .= ' WHERE is_published = 1';
        }
        $sql .= ' ORDER BY activity_date ASC, start_time ASC';

        return db()->query($sql)->fetchAll();
    }

    public static function upcoming(int $limit = 3): array
    {
        $stmt = db()->prepare('
            SELECT * FROM activities
            WHERE is_published = 1
            ORDER BY activity_date ASC, start_time ASC
            LIMIT :activity_limit
        ');
        $stmt->bindValue(':activity_limit', $limit, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll();
    }

    public static function find(int $id): ?array
    {
        $stmt = db()->prepare('SELECT * FROM activities WHERE id = :id LIMIT 1');
        $stmt->execute(['id' => $id]);
        $item = $stmt->fetch();

        return $item ?: null;
    }

    public static function create(array $data): bool
    {
        $stmt = db()->prepare('
            INSERT INTO activities (title, description, activity_date, start_time, end_time, location, price, image, is_published)
            VALUES (:title, :description, :activity_date, :start_time, :end_time, :location, :price, :image, :is_published)
        ');

        return $stmt->execute($data);
    }

    public static function update(int $id, array $data): bool
    {
        $data['id'] = $id;
        $stmt = db()->prepare('
            UPDATE activities
            SET title = :title, description = :description, activity_date = :activity_date, start_time = :start_time,
                end_time = :end_time, location = :location, price = :price, image = :image, is_published = :is_published
            WHERE id = :id
        ');

        return $stmt->execute($data);
    }

    public static function delete(int $id): bool
    {
        $stmt = db()->prepare('DELETE FROM activities WHERE id = :id');
        return $stmt->execute(['id' => $id]);
    }

    public static function countPublished(): int
    {
        return (int) db()->query('SELECT COUNT(*) FROM activities WHERE is_published = 1')->fetchColumn();
    }
}
