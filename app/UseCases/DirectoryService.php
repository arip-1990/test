<?php

namespace App\UseCases;

use App\Models\Directory;
use Illuminate\Support\Facades\Storage;

class DirectoryService
{
    public function create(string $name, ?Directory $parentDirectory = null): Directory
    {
        $path = $parentDirectory ? (self::getDirectoryPath($parentDirectory) . $name) : $name;
        if (!Storage::makeDirectory($path))
            throw new \DomainException('Не удалось создать директорию');

        return Directory::create(['name' => $name]);
    }

    public function rename(Directory $directory, string $newName): Directory
    {
        $oldPath = self::getDirectoryPath($directory);
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
        if (!Storage::deleteDirectory(self::getDirectoryPath($directory)))
            throw new \DomainException('Не удалось удалить директорию');

        $directory->delete();
    }

    public static function getDirectoryPath(Directory $directory): string
    {
        $path = $directory->name;
        while ($directory = $directory->parent) {
            $path = $directory->name . '/' . $path;
        }

        return $path;
    }
}
