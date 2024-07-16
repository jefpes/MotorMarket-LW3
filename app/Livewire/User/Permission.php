<?php

declare(strict_types = 1);

namespace App\Livewire\User;

trait Permission
{
    public string $permission_create = 'user_create';

    public string $permission_read = 'user_read';

    public string $permission_update = 'user_update';

    public string $permission_delete = 'user_delete';

    public string $permission_admin = 'admin';
}
