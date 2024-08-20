<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Storage;

/**
 * @property int $id
 * @property string $name
 * @property string $type
 * @property ?Carbon $created_at
 * @property ?Carbon $updated_at
 *
 * @property ?Directory $directory
 */
class File extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'type'];

    public function getPath(): string
    {
        $path = $this->directory->getPath();

        return $path . '/' . $this->name;
    }

    public function getSize(): int
    {
        $path = $this->directory->getPath();

        if (Storage::exists($path . '/' . $this->name))
            return Storage::size($path . '/' . $this->name);

        return 0;
    }

    public function directory(): BelongsTo
    {
        return $this->belongsTo(self::class, 'directory_id');
    }
}
