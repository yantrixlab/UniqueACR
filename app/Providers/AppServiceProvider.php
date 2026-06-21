<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Symfony\Component\HtmlSanitizer\HtmlSanitizerConfig;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Allow <iframe> embeds (YouTube/Vimeo, inserted only via the
        // blog editor's VideoEmbedBlock) to survive Filament's default
        // HTML sanitizer, which excludes iframes from `allowSafeElements()`.
        $this->app->extend(HtmlSanitizerConfig::class, function (HtmlSanitizerConfig $config): HtmlSanitizerConfig {
            return $config->allowElement('iframe', ['src', 'allow', 'allowfullscreen', 'loading', 'frameborder', 'title']);
        });
    }
}
