<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Employee extends Model
{
    use HasFactory;

    public function address(): HasOne
    {
        return $this->hasOne(EmployeeAddress::class);
    }

    public function photos(): HasMany
    {
        return $this->hasMany(EmployeePhotos::class);
    }
}
