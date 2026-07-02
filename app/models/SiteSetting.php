<?php

declare(strict_types=1);

class SiteSetting
{
    public static function all(): array
    {
        $items = db()->query('SELECT setting_key, setting_value FROM site_settings ORDER BY setting_key ASC')->fetchAll();
        $settings = [];

        foreach ($items as $item) {
            $settings[$item['setting_key']] = self::normalizeValue(
                $item['setting_key'],
                (string) $item['setting_value']
            );
        }

        return $settings;
    }

    public static function get(string $key, string $default = ''): string
    {
        $stmt = db()->prepare('SELECT setting_value FROM site_settings WHERE setting_key = :setting_key LIMIT 1');
        $stmt->execute(['setting_key' => $key]);
        $value = $stmt->fetchColumn();

        return $value !== false ? self::normalizeValue($key, (string) $value) : self::normalizeValue($key, $default);
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

    private static function normalizeValue(string $key, string $value): string
    {
        if ($key === 'facebook_url') {
            return normalize_facebook_url($value);
        }

        if ($key === 'donation_url') {
            return normalize_donation_url($value);
        }

        return $value;
    }
}
