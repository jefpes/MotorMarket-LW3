<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Collection;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory;
    use Notifiable;

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'password' => 'hashed',
        ];
    }

    public function scopeSearch(Builder $q, string $val): Builder
    {
        return $q->where('name', 'like', "%{$val}%")->orWhere('user_name', 'like', "%{$val}%");
    }

    public function scopeLoged(Builder $q): Builder
    {
        return $q->where('id', '!=', auth()->user()->id);
    }

    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(Role::class)->with('abilities');
    }

    public function abilities(): Collection
    {
        return $this->roles->map->abilities->flatten()->pluck('name');
    }

    public function hierarchy(int $id): bool
    {
        $h_user_loged = $this->roles()->pluck('hierarchy')->max();
        $h_user_param = (User::find($id)->roles()->pluck('hierarchy')->max() ?? $h_user_loged + 1);

        return $h_user_loged <= $h_user_param;
    }
}
