<?php

namespace App\Support;

class TextRepair
{
    public static function clean(?string $value): string
    {
        if ($value === null || $value === '') {
            return '';
        }

        return strtr($value, [
            'â€”' => '—',
            'â€“' => '–',
            'â€˜' => '‘',
            'â€™' => '’',
            'â€œ' => '“',
            'â€' => '”',
            'â€' => '”',
            'â‚¹' => '₹',
            'â‰ˆ' => '≈',
            'âš ' => '⚠',
            'âœ“' => '✓',
            'Â·' => '·',
            'Â°C' => '°C',
            'Â ' => ' ',
            'Â' => '',
            'ðŸ“ž' => '☎',
            'ðŸ’¬' => 'WhatsApp',
            'ðŸŒ' => 'Book Online',
            'ðŸ“' => '📍',
        ]);
    }
}
