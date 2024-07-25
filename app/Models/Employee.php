<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\{HasMany, HasOne};

class Employee extends Model
{
    use HasFactory;

    public function address(): HasOne
    {
        return $this->hasOne(EmployeeAddress::class);
    }

    public function company(): HasOne
    {
        return $this->hasOne(Company::class);
    }

    public function photos(): HasMany
    {
        return $this->hasMany(EmployeePhotos::class);
    }

    public function user(): HasOne
    {
        return $this->hasOne(User::class);
    }
}
