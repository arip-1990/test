<?php

namespace App\UseCases;

use App\Models\Directory;
use Illuminate\Support\Facades\Storage;

class DirectoryService
{
    public function create(string $name, ?Directory $parentDirectory = null): Directory
    {
        $path = $parentDirectory ? ($parentDirectory->getPath() . $name) : $name;
        if (!Storage::makeDirectory($path))
            throw new \DomainException('Не удалось создать директорию');

        return Directory::create(['name' => $name]);
    }

    public function rename(Directory $directory, string $newName): Directory
    {
        $oldPath = $directory->getPath();
        $newPath = explode('/', $oldPath);
        array_pop($newPath);
        $newPath = implode('/', $newPath) . '/' . $newName;

        if (!Storage::directoryExists($oldPath) or !Storage::move($oldPath, $newPath))
            throw new \DomainException('Не удалось переименовать директорию');

        $directory->update(['name' => $newName]);

        return $directory;
    }

    public function delete(Directory $directory): void
    {
        if (!Storage::deleteDirectory($directory->getPath()))
            throw new \DomainException('Не удалось удалить директорию');

        $directory->delete();
    }
}
