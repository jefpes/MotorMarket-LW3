<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\{BelongsTo, HasMany};

class Client extends Model
{
    use HasFactory;

    public function photos(): HasMany
    {
        return $this->hasMany(ClientPhoto::class);
    }

    public function city(): BelongsTo
    {
        return $this->belongsTo(City::class);
    }
}
