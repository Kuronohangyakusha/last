<?php
// 1. Correction de ImageService.php
namespace App\Core;

class ImageService {
    private string $uploadDir;
    private array $allowedTypes = ['image/jpeg', 'image/png', 'image/jpg'];
    private int $maxSize = 5242880; // 5MB
    private static ?ImageService $instance = null;

    public function __construct() {
        $this->uploadDir = $_SERVER['DOCUMENT_ROOT'] . '/uploads/';
        if (!is_dir($this->uploadDir)) {
            mkdir($this->uploadDir, 0755, true);
        }
    }

    public static function getInstance(): self {
        if (self::$instance === null) {
            self::$instance = new static();
        }
        return self::$instance;
    }

    public function uploadImage(array $file): string|false {
        if (!isset($file['tmp_name']) || empty($file['tmp_name'])) {
            return false;
        }

        // Vérifier les erreurs
        if ($file['error'] !== UPLOAD_ERR_OK) {
            return false;
        }

        // Vérifier le type de fichier
        if (!in_array($file['type'], $this->allowedTypes)) {
            return false;
        }

        // Vérifier la taille
        if ($file['size'] > $this->maxSize) {
            return false;
        }

         
        $extension = pathinfo($file['name'], PATHINFO_EXTENSION);
        $filename = uniqid() . '_' . time() . '.' . $extension;
        $destination = $this->uploadDir . $filename;

        if (move_uploaded_file($file['tmp_name'], $destination)) {
            return 'uploads/' . $filename;  
        }

        return false;
    }
}