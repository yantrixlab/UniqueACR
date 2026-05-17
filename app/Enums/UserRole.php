<?php

namespace App\Enums;

enum UserRole: string
{
    case SuperAdmin = 'super_admin';
    case Admin = 'admin';
    case Employee = 'employee';
    case Customer = 'customer';

    public static function panelRoles(): array
    {
        return [self::SuperAdmin->value, self::Admin->value, self::Employee->value];
    }
}
