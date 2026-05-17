<?php

namespace App\Filament\Resources;

use App\Models\User;
use Filament\Resources\Resource;
use Illuminate\Support\Str;

abstract class BaseResource extends Resource
{
    public static function canViewAny(): bool
    {
        /** @var User|null $user */
        $user = auth()->user();

        if (! $user) {
            return false;
        }

        if ($user->isSuperAdmin()) {
            return true;
        }

        return $user->hasPermission(static::permissionKey('view'));
    }

    public static function canCreate(): bool
    {
        return static::canViewAny();
    }

    public static function canEdit($record): bool
    {
        return static::canViewAny();
    }

    public static function canDelete($record): bool
    {
        return static::canViewAny();
    }

    public static function canDeleteAny(): bool
    {
        return static::canViewAny();
    }

    protected static function permissionKey(string $action): string
    {
        $slug = Str::of(class_basename(static::class))->beforeLast('Resource')->snake()->toString();

        return "resource.{$slug}.{$action}";
    }
}

