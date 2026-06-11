<?php

declare(strict_types=1);

class SiteSetting
{
    public static function all(): array
    {
        $items = db()->query('SELECT setting_key, setting_value FROM site_settings ORDER BY setting_key ASC')->fetchAll();
        $settings = [];

        foreach ($items as $item) {
            $settings[$item['setting_key']] = $item['setting_value'];
        }

        return $settings;
    }

    public static function get(string $key, string $default = ''): string
    {
        $stmt = db()->prepare('SELECT setting_value FROM site_settings WHERE setting_key = :setting_key LIMIT 1');
        $stmt->execute(['setting_key' => $key]);
        $value = $stmt->fetchColumn();

        return $value !== false ? (string) $value : $default;
    }

    public static function upsertMany(array $settings): void
    {
        $stmt = db()->prepare('
            INSERT INTO site_settings (setting_key, setting_value)
            VALUES (:setting_key, :setting_value)
            ON DUPLICATE KEY UPDATE setting_value = VALUES(setting_value)
        ');

        foreach ($settings as $key => $value) {
            $stmt->execute([
                'setting_key' => $key,
                'setting_value' => $value,
            ]);
        }
    }
}
