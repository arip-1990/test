<?php

namespace App\UseCases;

use App\Models\Directory;
use App\Models\File;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class FileService
{
    public function store(array $files, int $directoryId): void
    {
        $items = [];
        $directory = Directory::find($directoryId);
        $path = $directory->getPath();

        /** @var UploadedFile $file */
        foreach ($files as $file) {
            $fileName = $file->getClientOriginalName();
            if (!$file->storeAs($path, $fileName))
                throw new \DomainException('Не удалось сохранить файл');

            $items[] = new File(['name' => $fileName, 'type' => $file->getClientMimeType()]);
        }

        $directory?->files()->saveMany($items);
    }

    public function rename(int $fileId, string $newName): void
    {
        $file = File::find($fileId);
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
