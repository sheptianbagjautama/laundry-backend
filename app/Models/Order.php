<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'sale_id',
        'customer_name',
        'customer_address',
        'customer_phone',
        'total_qty'
    ];

    public function sale(): BelongsTo
    {
        return $this->belongsTo(Sales::class);
    }
}
