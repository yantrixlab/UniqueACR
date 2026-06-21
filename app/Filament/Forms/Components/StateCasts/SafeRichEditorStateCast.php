<?php

namespace App\Filament\Forms\Components\StateCasts;

use Filament\Forms\Components\RichEditor\StateCasts\RichEditorStateCast;
use Throwable;

class SafeRichEditorStateCast extends RichEditorStateCast
{
    public function get(mixed $state): string|array
    {
        try {
            return parent::get($state);
        } catch (Throwable $exception) {
            if (! is_array($state)) {
                throw $exception;
            }
        }

        try {
            return parent::get($this->isolateInlineMarks($state));
        } catch (Throwable) {
            return $this->renderBasicHtml($state);
        }
    }

    /**
     * The TipTap PHP serializer can underflow its internal mark stack when it
     * reuses inline marks across adjacent nodes. Giving each mark object a
     * harmless unique boundary makes the serializer open and close marks per
     * text node, which keeps the stack balanced without changing visible HTML.
     *
     * @param  array<string, mixed>  $document
     * @return array<string, mixed>
     */
    protected function isolateInlineMarks(array $document): array
    {
        $counter = 0;

        $walk = function (array &$node) use (&$walk, &$counter): void {
            if (isset($node['marks']) && is_array($node['marks'])) {
                foreach ($node['marks'] as &$mark) {
                    if (! is_array($mark)) {
                        continue;
                    }

                    $mark['attrs'] ??= [];

                    if (is_array($mark['attrs'])) {
                        $mark['attrs']['dataSafeRichEditorBoundary'] = ++$counter;
                    }
                }
            }

            if (! isset($node['content']) || ! is_array($node['content'])) {
                return;
            }

            foreach ($node['content'] as &$child) {
                if (is_array($child)) {
                    $walk($child);
                }
            }
        };

        $walk($document);

        return $document;
    }

    /**
     * @param  array<string, mixed>  $document
     */
    protected function renderBasicHtml(array $document): string
    {
        $content = $document['content'] ?? [];

        if (! is_array($content)) {
            return '';
        }

        return collect($content)
            ->filter(fn (mixed $node): bool => is_array($node))
            ->map(fn (array $node): string => $this->renderNode($node))
            ->implode('');
    }

    /**
     * @param  array<string, mixed>  $node
     */
    protected function renderNode(array $node): string
    {
        $children = $this->renderChildren($node);

        return match ($node['type'] ?? null) {
            'heading' => $this->wrap('h'.min(6, max(1, (int) ($node['attrs']['level'] ?? 2))), $children),
            'paragraph' => $this->wrap('p', $children),
            'blockquote' => $this->wrap('blockquote', $children),
            'bulletList' => $this->wrap('ul', $children),
            'orderedList' => $this->wrap('ol', $children),
            'listItem' => $this->wrap('li', $children),
            'codeBlock' => '<pre><code>'.e($this->textContent($node)).'</code></pre>',
            'horizontalRule' => '<hr>',
            'hardBreak' => '<br>',
            'image' => $this->renderImage($node),
            'text' => $this->renderMarkedText($node),
            default => $children,
        };
    }

    /**
     * @param  array<string, mixed>  $node
     */
    protected function renderChildren(array $node): string
    {
        $content = $node['content'] ?? [];

        if (! is_array($content)) {
            return '';
        }

        return collect($content)
            ->filter(fn (mixed $child): bool => is_array($child))
            ->map(fn (array $child): string => $this->renderNode($child))
            ->implode('');
    }

    /**
     * @param  array<string, mixed>  $node
     */
    protected function renderMarkedText(array $node): string
    {
        $html = e((string) ($node['text'] ?? ''));
        $marks = $node['marks'] ?? [];

        if (! is_array($marks)) {
            return $html;
        }

        foreach (array_reverse($marks) as $mark) {
            if (! is_array($mark)) {
                continue;
            }

            $html = match ($mark['type'] ?? null) {
                'bold' => '<strong>'.$html.'</strong>',
                'italic' => '<em>'.$html.'</em>',
                'underline' => '<u>'.$html.'</u>',
                'strike' => '<s>'.$html.'</s>',
                'code' => '<code>'.$html.'</code>',
                'subscript' => '<sub>'.$html.'</sub>',
                'superscript' => '<sup>'.$html.'</sup>',
                'link' => $this->renderLink($html, $mark),
                default => $html,
            };
        }

        return $html;
    }

    /**
     * @param  array<string, mixed>  $mark
     */
    protected function renderLink(string $html, array $mark): string
    {
        $href = $mark['attrs']['href'] ?? null;

        if (blank($href)) {
            return $html;
        }

        return '<a href="'.e($href).'">'.$html.'</a>';
    }

    /**
     * @param  array<string, mixed>  $node
     */
    protected function renderImage(array $node): string
    {
        $src = $node['attrs']['src'] ?? $node['attrs']['id'] ?? null;

        if (blank($src)) {
            return '';
        }

        $alt = $node['attrs']['alt'] ?? '';

        return '<img src="'.e($src).'" alt="'.e($alt).'">';
    }

    /**
     * @param  array<string, mixed>  $node
     */
    protected function textContent(array $node): string
    {
        if (($node['type'] ?? null) === 'text') {
            return (string) ($node['text'] ?? '');
        }

        $content = $node['content'] ?? [];

        if (! is_array($content)) {
            return '';
        }

        return collect($content)
            ->filter(fn (mixed $child): bool => is_array($child))
            ->map(fn (array $child): string => $this->textContent($child))
            ->implode('');
    }

    protected function wrap(string $tag, string $html): string
    {
        return "<{$tag}>{$html}</{$tag}>";
    }
}
