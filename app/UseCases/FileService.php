<?php

namespace App\UseCases;

use App\Models\Directory;
use App\Models\File;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class FileService
{
    public function store(array $files, Directory $directory = null): void
    {
        $items = [];
        $path = $directory ? $directory->getPath() : '.';

        /** @var UploadedFile $file */
        foreach ($files as $file) {
            $fileName = explode('.', $file->getClientOriginalName())[0];
            $fileType = strtolower($file->getClientOriginalExtension());

            if (!$file->storeAs($path, $fileName . '.' . $fileType))
                throw new \DomainException('Не удалось сохранить файл');

            $items[] = new File(['name' => $fileName, 'type' => $fileType]);
        }

        $directory?->files()->saveMany($items);
    }

    public function rename(File $file, string $newName): void
    {
        $path = $file->directory->getPath();
        $oldFile = $path . $file->name . '.' . $file->type;

        if (!Storage::exists($oldFile) or !Storage::move($oldFile, $path . $newName . '.' . $file->type))
            throw new \DomainException('Не удалось переименовать файл');
    }

    public function delete(array $files): void
    {
        /** @var File $file */
        foreach ($files as $file) {
            $path = $file->directory->getPath() . $file->name . '.' . $file->type;
            if (!Storage::exists($path) or !Storage::delete($path))
                throw new \DomainException('Не удалось удалить файл');

            $file->delete();
        }
    }
}
