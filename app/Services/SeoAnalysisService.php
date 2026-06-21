<?php

namespace App\Services;

use Illuminate\Support\Str;

/**
 * Pure-PHP, Yoast/RankMath-style SEO + readability analysis for blog posts.
 *
 * Deliberately does not attempt Flesch-Kincaid reading-ease or passive-voice
 * detection — both need reliable syllable counting / POS tagging to be
 * trustworthy, which isn't achievable with plain PHP regex.
 */
class SeoAnalysisService
{
    /**
     * @param array{title?: ?string, slug?: ?string, meta_title?: ?string, meta_description?: ?string, focus_keyword?: ?string, content?: ?string} $data
     */
    public function analyze(array $data): array
    {
        $title = (string) ($data['title'] ?? '');
        $slug = (string) ($data['slug'] ?? '');
        $metaTitle = (string) ($data['meta_title'] ?? '');
        $metaDescription = (string) ($data['meta_description'] ?? '');
        $keyword = trim((string) ($data['focus_keyword'] ?? ''));
        $content = (string) ($data['content'] ?? '');

        $effectiveTitle = $metaTitle !== '' ? $metaTitle : $title;
        $plainText = trim(preg_replace('/\s+/', ' ', html_entity_decode(strip_tags($content))) ?? '');
        $wordCount = $plainText === '' ? 0 : str_word_count($plainText);

        $seo = [];
        $hasKeyword = $keyword !== '';

        $seo[] = $this->check(
            'Focus keyword',
            $hasKeyword,
            $hasKeyword ? "Focus keyword set: \"{$keyword}\"." : 'Add a focus keyword to unlock keyword-based checks.',
        );

        if ($hasKeyword) {
            $inTitle = $this->containsKeyword($effectiveTitle, $keyword);
            $seo[] = $this->check(
                'Keyword in SEO title',
                $inTitle,
                $inTitle ? 'The focus keyword appears in the SEO title.' : 'The focus keyword does not appear in the SEO title.',
            );

            $inSlug = $this->containsKeyword(str_replace(['-', '_'], ' ', $slug), $keyword);
            $seo[] = $this->check(
                'Keyword in URL',
                $inSlug,
                $inSlug ? 'The slug contains the focus keyword.' : 'Consider adding the focus keyword to the URL slug.',
            );

            $inMetaDescription = $this->containsKeyword($metaDescription, $keyword);
            $seo[] = $this->check(
                'Keyword in meta description',
                $inMetaDescription,
                $inMetaDescription ? 'The meta description contains the focus keyword.' : 'Add the focus keyword to the meta description.',
            );

            $firstWords = implode(' ', array_slice(preg_split('/\s+/', $plainText) ?: [], 0, 100));
            $inIntro = $this->containsKeyword($firstWords, $keyword);
            $seo[] = $this->check(
                'Keyword in introduction',
                $inIntro,
                $inIntro ? 'The focus keyword appears early in the content.' : 'Use the focus keyword within the first 100 words.',
            );

            $occurrences = $wordCount > 0 ? substr_count(Str::lower($plainText), Str::lower($keyword)) : 0;
            $density = $wordCount > 0 ? ($occurrences / $wordCount) * 100 : 0;
            $densityGood = $density >= 0.5 && $density <= 2.5;
            $seo[] = $this->check(
                'Keyword density',
                $densityGood,
                $density > 0
                    ? sprintf('Keyword density is %.1f%% — %s.', $density, $densityGood ? 'within the ideal range' : 'aim for 0.5%–2.5%')
                    : 'The focus keyword does not appear in the content yet.',
                status: $densityGood ? 'good' : ($density > 0 ? 'ok' : 'bad'),
            );
        }

        $titleLength = Str::length($effectiveTitle);
        $titleGood = $titleLength >= 40 && $titleLength <= 60;
        $seo[] = $this->check(
            'SEO title length',
            $titleGood,
            "SEO title is {$titleLength} characters (aim for 40–60).",
            status: $titleGood ? 'good' : ($titleLength > 0 ? 'ok' : 'bad'),
        );

        $descriptionLength = Str::length($metaDescription);
        $descriptionGood = $descriptionLength >= 120 && $descriptionLength <= 156;
        $seo[] = $this->check(
            'Meta description length',
            $descriptionGood,
            "Meta description is {$descriptionLength} characters (aim for 120–156).",
            status: $descriptionGood ? 'good' : ($descriptionLength > 0 ? 'ok' : 'bad'),
        );

        $lengthGood = $wordCount >= 300;
        $seo[] = $this->check(
            'Content length',
            $lengthGood,
            "Content has {$wordCount} words (aim for 300+).",
            status: $lengthGood ? 'good' : ($wordCount > 0 ? 'ok' : 'bad'),
        );

        $hasImage = (bool) preg_match('/<img[\s>]/i', $content);
        $seo[] = $this->check(
            'Image in content',
            $hasImage,
            $hasImage ? 'At least one image is included.' : 'Add at least one image to improve engagement.',
        );

        $hasLink = (bool) preg_match('/<a\s/i', $content);
        $seo[] = $this->check(
            'Links in content',
            $hasLink,
            $hasLink ? 'Content includes at least one link.' : 'Add an internal or external link.',
        );

        $readability = [];

        $sentenceCount = max(1, preg_match_all('/[.!?]+/', $plainText));
        $avgSentenceLength = $wordCount > 0 ? $wordCount / $sentenceCount : 0;
        $sentenceGood = $avgSentenceLength > 0 && $avgSentenceLength <= 20;
        $readability[] = $this->check(
            'Sentence length',
            $sentenceGood,
            $avgSentenceLength > 0
                ? sprintf('Average sentence length is %.0f words.', $avgSentenceLength)
                : 'Add content to analyze sentence length.',
            status: $sentenceGood ? 'good' : ($avgSentenceLength > 0 ? 'ok' : 'bad'),
        );

        $hasSubheadings = (bool) preg_match('/<h[2-4][\s>]/i', $content);
        $readability[] = $this->check(
            'Subheadings',
            $hasSubheadings,
            $hasSubheadings ? 'Subheadings are used to break up the content.' : 'Add H2/H3 subheadings to structure the content.',
        );

        $paragraphs = preg_split('/<\/p>/i', $content) ?: [];
        $longParagraph = false;
        foreach ($paragraphs as $paragraph) {
            $text = trim(strip_tags($paragraph));
            if ($text !== '' && str_word_count($text) > 150) {
                $longParagraph = true;
                break;
            }
        }
        $readability[] = $this->check(
            'Paragraph length',
            ! $longParagraph,
            $longParagraph ? 'Some paragraphs are too long — break them up for readability.' : 'Paragraph lengths look good.',
        );

        $score = $this->score($seo, $readability);

        return [
            'score' => $score,
            'grade' => $this->grade($score),
            'gradeColor' => $this->gradeColor($score),
            'seo' => $seo,
            'readability' => $readability,
        ];
    }

    private function check(string $label, bool $passed, string $message, ?string $status = null): array
    {
        return [
            'label' => $label,
            'status' => $status ?? ($passed ? 'good' : 'bad'),
            'message' => $message,
        ];
    }

    private function containsKeyword(string $haystack, string $keyword): bool
    {
        return $keyword !== '' && Str::contains(Str::lower($haystack), Str::lower($keyword));
    }

    private function points(array $checks): float
    {
        return array_sum(array_map(
            fn (array $check): float => match ($check['status']) {
                'good' => 1,
                'ok' => 0.5,
                default => 0,
            },
            $checks,
        ));
    }

    private function score(array $seo, array $readability): int
    {
        $seoScore = count($seo) > 0 ? ($this->points($seo) / count($seo)) * 100 : 0;
        $readabilityScore = count($readability) > 0 ? ($this->points($readability) / count($readability)) * 100 : 0;

        return (int) round(($seoScore * 0.6) + ($readabilityScore * 0.4));
    }

    private function grade(int $score): string
    {
        return match (true) {
            $score >= 80 => 'Excellent',
            $score >= 60 => 'Good',
            $score >= 40 => 'Needs improvement',
            default => 'Poor',
        };
    }

    private function gradeColor(int $score): string
    {
        return match (true) {
            $score >= 70 => 'green',
            $score >= 40 => 'amber',
            default => 'red',
        };
    }
}
