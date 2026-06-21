<?php

use App\Models\BlogPost;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Wraps legacy plain-text post content (no HTML tags at all) in <p> tags.
     *
     * The rich editor's TipTap-based state cast can throw when it tries to
     * round-trip plain text that isn't valid (X)HTML, crashing any part of
     * the admin form that reads the field's value (e.g. the SEO panel).
     * Wrapping it in paragraphs makes it valid HTML the editor can parse.
     */
    public function up(): void
    {
        BlogPost::query()
            ->whereNotNull('content')
            ->where('content', 'not like', '%<%')
            ->each(function (BlogPost $post): void {
                $paragraphs = preg_split('/\r?\n+/', trim($post->content)) ?: [];

                $html = collect($paragraphs)
                    ->filter()
                    ->map(fn (string $paragraph) => '<p>' . e($paragraph) . '</p>')
                    ->implode('');

                $post->forceFill(['content' => $html ?: '<p></p>'])->save();
            });
    }

    public function down(): void
    {
        // Not reversible: the original plain-text formatting isn't recoverable
        // from the wrapped HTML alone.
    }
};
