<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $id
 * @property string $customer_name
 * @property int $quantity
 * @property string $note
 * @property string $status
 * @property ?Carbon $created_at
 * @property ?Carbon $updated_at
 *
 * @property Product $product
 */
class Order extends Model
{
    use HasFactory;

    const STATUS_NEW = 'new';
    const STATUS_COMPLETED = 'completed';

    protected $fillable = ['customer_name', 'quantity', 'note', 'status'];

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function getTotalPriceAttribute(): float
    {
        return $this->product->price * $this->quantity;
    }
}
