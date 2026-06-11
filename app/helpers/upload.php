<?php

declare(strict_types=1);

function upload_image(string $fieldName, string $directory): ?string
{
    if (empty($_FILES[$fieldName]['name']) || ($_FILES[$fieldName]['error'] ?? UPLOAD_ERR_NO_FILE) === UPLOAD_ERR_NO_FILE) {
        return null;
    }

    if (($_FILES[$fieldName]['error'] ?? UPLOAD_ERR_OK) !== UPLOAD_ERR_OK) {
        throw new RuntimeException('Le televersement du fichier a echoue.');
    }

    $allowedMimeTypes = [
        'image/jpeg' => 'jpg',
        'image/png' => 'png',
        'image/webp' => 'webp',
    ];

    $tmpName = $_FILES[$fieldName]['tmp_name'];
    $mimeType = mime_content_type($tmpName);

    if (!isset($allowedMimeTypes[$mimeType])) {
        throw new RuntimeException('Format de fichier non autorise.');
    }

    $extension = $allowedMimeTypes[$mimeType];
    $filename = $directory . '/' . date('YmdHis') . '-' . bin2hex(random_bytes(8)) . '.' . $extension;
    $destination = UPLOADS_PATH . '/' . $filename;

    $targetDir = dirname($destination);
    if (!is_dir($targetDir)) {
        mkdir($targetDir, 0775, true);
    }

    if (!move_uploaded_file($tmpName, $destination)) {
        throw new RuntimeException('Impossible d\'enregistrer le fichier envoye.');
    }

    $publicMirrorPath = PUBLIC_MIRROR_ASSETS_PATH . '/uploads/' . $filename;
    $publicMirrorDir = dirname($publicMirrorPath);
    if (!is_dir($publicMirrorDir)) {
        mkdir($publicMirrorDir, 0775, true);
    }

    copy($destination, $publicMirrorPath);

    return $filename;
}
