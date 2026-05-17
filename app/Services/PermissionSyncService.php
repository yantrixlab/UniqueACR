<?php

namespace App\Services;

use App\Models\Permission;
use Filament\Resources\Resource;
use RecursiveDirectoryIterator;
use RecursiveIteratorIterator;
use Illuminate\Support\Str;

class PermissionSyncService
{
    public function syncResourcePermissions(): void
    {
        foreach ($this->discoverResourceClasses() as $resourceClass) {
            $resourceName = class_basename($resourceClass);
            $resourceSlug = Str::of($resourceName)->beforeLast('Resource')->snake()->toString();
            $navigationLabel = method_exists($resourceClass, 'getNavigationLabel')
                ? $resourceClass::getNavigationLabel()
                : Str::headline($resourceSlug);

            Permission::query()->updateOrCreate(
                ['key' => "resource.{$resourceSlug}.view"],
                ['label' => "View {$navigationLabel}", 'group' => 'Resources']
            );
        }
    }

    /**
     * @return array<int, class-string<Resource>>
     */
    private function discoverResourceClasses(): array
    {
        $classes = [];

        $resourceDir = app_path('Filament/Resources');
        $iterator = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($resourceDir));

        foreach ($iterator as $fileInfo) {
            if (! $fileInfo->isFile() || ! Str::endsWith($fileInfo->getFilename(), 'Resource.php')) {
                continue;
            }

            $relativePath = str_replace([$resourceDir.DIRECTORY_SEPARATOR, '.php', DIRECTORY_SEPARATOR], ['', '', '\\'], $fileInfo->getPathname());
            $class = 'App\\Filament\\Resources\\'.$relativePath;

            if (class_exists($class) && is_subclass_of($class, Resource::class)) {
                $classes[] = $class;
            }
        }

        return $classes;
    }
}
