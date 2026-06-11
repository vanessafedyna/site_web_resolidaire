<?php

declare(strict_types=1);

class TeamMember
{
    public static function all(bool $activeOnly = false): array
    {
        $sql = 'SELECT * FROM team_members';
        if ($activeOnly) {
            $sql .= ' WHERE is_active = 1';
        }
        $sql .= ' ORDER BY display_order ASC, name ASC';

        return db()->query($sql)->fetchAll();
    }

    public static function find(int $id): ?array
    {
        $stmt = db()->prepare('SELECT * FROM team_members WHERE id = :id LIMIT 1');
        $stmt->execute(['id' => $id]);
        $item = $stmt->fetch();

        return $item ?: null;
    }

    public static function create(array $data): bool
    {
        $stmt = db()->prepare('
            INSERT INTO team_members (name, job_title, phone_extension, email, photo, bio, display_order, is_active)
            VALUES (:name, :job_title, :phone_extension, :email, :photo, :bio, :display_order, :is_active)
        ');

        return $stmt->execute($data);
    }

    public static function update(int $id, array $data): bool
    {
        $data['id'] = $id;
        $stmt = db()->prepare('
            UPDATE team_members
            SET name = :name, job_title = :job_title, phone_extension = :phone_extension, email = :email,
                photo = :photo, bio = :bio, display_order = :display_order, is_active = :is_active
            WHERE id = :id
        ');

        return $stmt->execute($data);
    }

    public static function delete(int $id): bool
    {
        $stmt = db()->prepare('DELETE FROM team_members WHERE id = :id');
        return $stmt->execute(['id' => $id]);
    }

    public static function countActive(): int
    {
        return (int) db()->query('SELECT COUNT(*) FROM team_members WHERE is_active = 1')->fetchColumn();
    }
}
