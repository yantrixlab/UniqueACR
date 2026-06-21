<?php

namespace App\Filament\Resources\BlogPosts\Blocks;

use Filament\Actions\Action;
use Filament\Forms\Components\RichEditor\RichContentCustomBlock;
use Filament\Forms\Components\TextInput;

/**
 * Lets authors embed a YouTube or Vimeo video inside blog post content by
 * pasting its URL. Renders a responsive iframe embed; falls back to a plain
 * link if the URL isn't a recognized YouTube/Vimeo format.
 */
class VideoEmbedBlock extends RichContentCustomBlock
{
    public static function getId(): string
    {
        return 'videoEmbed';
    }

    public static function getLabel(): string
    {
        return 'Video Embed';
    }

    public static function configureEditorAction(Action $action): Action
    {
        return $action
            ->modalDescription('Paste a YouTube or Vimeo video URL to embed it in the post.')
            ->schema([
                TextInput::make('url')
                    ->label('Video URL')
                    ->placeholder('https://www.youtube.com/watch?v=...')
                    ->required()
                    ->url(),
            ]);
    }

    public static function toHtml(array $config, array $data): ?string
    {
        $url = $config['url'] ?? null;

        if (blank($url)) {
            return null;
        }

        $video = static::parseVideoUrl($url);

        if ($video === null) {
            return '<p><a href="' . e($url) . '" target="_blank" rel="noopener">' . e($url) . '</a></p>';
        }

        $embedUrl = $video['provider'] === 'youtube'
            ? "https://www.youtube.com/embed/{$video['id']}"
            : "https://player.vimeo.com/video/{$video['id']}";

        return '<div style="position:relative;padding-top:56.25%;margin:1.5em 0;border-radius:10px;overflow:hidden;background:#000;">'
            . '<iframe src="' . e($embedUrl) . '" style="position:absolute;top:0;left:0;width:100%;height:100%;border:0;" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen loading="lazy"></iframe>'
            . '</div>';
    }

    public static function toPreviewHtml(array $config): ?string
    {
        $url = $config['url'] ?? '';

        return '<div style="display:flex;align-items:center;gap:.6rem;padding:.85rem 1rem;border:1px solid rgba(148,163,184,.35);border-radius:10px;background:rgba(148,163,184,.08);">'
            . '<span style="display:inline-flex;align-items:center;justify-content:center;width:2rem;height:2rem;border-radius:50%;background:#ef4444;color:#fff;flex-shrink:0;font-size:.8rem;">&#9654;</span>'
            . '<span style="font-size:.85rem;color:inherit;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;">' . e($url ?: 'Video embed') . '</span>'
            . '</div>';
    }

    public static function shouldApplyProseStylingToPreview(array $config): bool
    {
        return false;
    }

    /**
     * @return array{provider: 'youtube'|'vimeo', id: string}|null
     */
    protected static function parseVideoUrl(string $url): ?array
    {
        if (preg_match('/(?:youtube\.com\/(?:watch\?v=|embed\/|shorts\/)|youtu\.be\/)([A-Za-z0-9_-]{11})/', $url, $matches)) {
            return ['provider' => 'youtube', 'id' => $matches[1]];
        }

        if (preg_match('/vimeo\.com\/(?:video\/)?(\d+)/', $url, $matches)) {
            return ['provider' => 'vimeo', 'id' => $matches[1]];
        }

        return null;
    }
}
