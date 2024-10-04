<?php

namespace App\UseCases;

use App\Models\Directory;
use Illuminate\Support\Facades\Storage;

class DirectoryService
{
    public function create(string $path): void
    {
        if (!Storage::makeDirectory($path))
            throw new \DomainException('Не удалось создать директорию ' . $path);
    }

    public function rename(int $path, string $newPath): void
    {
        if (!Storage::directoryExists($path) or !Storage::move($path, $newPath))
            throw new \DomainException('Не удалось переименовать директорию');
    }

    public function delete(int $path): void
    {
        if (!Storage::deleteDirectory($path))
            throw new \DomainException('Не удалось удалить директорию');
    }
}
