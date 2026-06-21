<?php

namespace App\Providers\Filament;

use App\Services\PermissionSyncService;
use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\AuthenticateSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Pages\Dashboard;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\Widgets\AccountWidget;
use Filament\Widgets\FilamentInfoWidget;
use Filament\View\PanelsRenderHook;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\PreventRequestForgery;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\Support\HtmlString;
use Illuminate\View\Middleware\ShareErrorsFromSession;

class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->default()
            ->id('admin')
            ->path('admin')
            ->login()
            ->colors([
                'primary' => Color::Amber,
            ])
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\Filament\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\Filament\Pages')
            ->pages([
                Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\Filament\Widgets')
            ->widgets([
                AccountWidget::class,
                FilamentInfoWidget::class,
            ])
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                PreventRequestForgery::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
            ])
            ->authMiddleware([
                Authenticate::class,
            ])
            ->bootUsing(function (): void {
                app(PermissionSyncService::class)->syncResourcePermissions();
            })
            ->renderHook(
                PanelsRenderHook::HEAD_END,
                function (): HtmlString {
                    $isBlogPostForm = request()->routeIs([
                        'filament.admin.resources.blog-posts.create',
                        'filament.admin.resources.blog-posts.edit',
                    ]);

                    $blogPostOverride = $isBlogPostForm
                        ? <<<'CSS'
                            main.fi-main {
                                max-width: 100% !important;
                                width: 100% !important;
                            }
                            CSS
                        : '';

                    return new HtmlString(<<<HTML
                        <style>
                            .fi-fo-rich-editor-content {
                                min-height: 32rem;
                            }
                            .fi-fo-rich-editor-content .ProseMirror {
                                min-height: 30rem;
                            }
                            @media (min-width: 1280px) {
                                .blog-post-sidebar {
                                    position: sticky;
                                    top: 6rem;
                                    align-self: start;
                                    max-height: calc(100vh - 7.5rem);
                                    overflow-y: auto;
                                }
                            }
                            {$blogPostOverride}
                        </style>
                        HTML
                    );
                },
            );
    }
}
