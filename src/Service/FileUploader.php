<?php

namespace App\Service;

class FileUploader
{
    private string $path;

    public function __construct(private array $extensions)
    {
        $this->path = dirname(__DIR__, 2) . '/public/';
    }

    public function upload(array $file): string|array
    {
        if ($file['size'] <= 0) {
            $errors = 'Vous devez renseigner une image mise en avant';
        } elseif (!in_array($file['type'], $this->extensions, true)) {
            $errors['thumbnailUrl'] = "L'image importée n'est pas valide. Extensions acceptées : " . implode(', ', $this->extensions);
        }

        if (!empty($errors)) {
            return $errors;
        }

        $thumbnailName = time() . '-' . $file['name'];
        move_uploaded_file($file['tmp_name'], "$this->path/images/$thumbnailName");

        return $thumbnailName;
    }

    public function remove(string $file): void
    {
        unlink($this->path . $file);
    }
}
