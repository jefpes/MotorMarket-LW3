<?php

namespace App\Utilities;

use App\Enums\Permission;

class Navigation
{
    /**
    * Create a navigation item.
    *
    * @param string $route
    * @param string $label
    * @param Permission $permission
    * @param array<string> $isActive
    * @return object
    */
    public static function createNavItem(string $route, string $label, Permission $permission, array $isActive = null): object
    {
        return (object)[
            'route'      => $route,
            'label'      => $label,
            'permission' => $permission->value,
            'isActive'   => request()->routeIs(array_merge([$route], $isActive)),
        ];
    }
}
