<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'type_id',
        'qty',
    ];


    // public function type(): HasOne
    // {
    //     return $this->hasOne(Type::class);
    // }

    public function type(): BelongsTo
    {
        return $this->belongsTo(Type::class);
    }

    public function groups(): BelongsToMany
    {
        return $this->belongsToMany(Group::class, 'group_product')->withPivot('id', 'qty', 'price')->withTimestamps();
    }
}
