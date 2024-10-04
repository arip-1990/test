<?php

namespace App\UseCases;

use App\Models\File;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\{Auth, Storage};

class FileService
{
    public function getFiles(string $path): mixed
    {
        return (new Collection(array_merge(Storage::directories($path), Storage::files($path))))
            ->map(function(string $file): array {
                $meta = [];
                $type = 'dir';
                $path = Storage::path($file);

                if (!is_dir($path)) {
                    $type = 'file';
                    $meta = [
                        'size' => Storage::size($file) * 1024,
                        'mimetype' => Storage::mimeType($file)
                    ];
                }

                $name = explode('/', $file);
                return [
                    'name' => array_pop($name),
                    'path' => str_replace(Storage::path('/'), '/', $path),
                    'time' => Storage::lastModified($file),
                    'type' => $type,
                    'meta' => $meta
                ];
            });
    }

    public function store(array $files, string $path): void
    {
        /** @var UploadedFile $file */
        foreach ($files as $file) {
            $fileName = $file->getClientOriginalName();
            if (!$file->storeAs($path, $fileName))
                throw new \DomainException('Не удалось сохранить файл');
        }
    }

    public function rename(string $file, string $newFile): void
    {
        if (!Storage::exists($file) or !Storage::move($file, $newFile))
            throw new \DomainException('Не удалось переименовать файл');
    }

    public function delete(array $files): void
    {
        Storage::delete($files);
    }

    public function createLink(string $rootPath, string $path): string
    {
        $publicPath = $rootPath . '/public';
        if (!Storage::exists($publicPath) and !Storage::makeDirectory($publicPath))
            throw new \DomainException('Не удалось создать директорию ' . $publicPath);

        $file = explode('/', $path);
        $symlink = Storage::path($publicPath) . '/' . array_pop($file);
        if (symlink(Storage::path($path), $symlink) === false)
            throw new \DomainException('Не удалось создать ссылку на файл ' . Storage::path($path));
        
        return $symlink;
    }
}
