<?php

namespace App\Filament\Forms\Components;

use App\Filament\Forms\Components\StateCasts\SafeRichEditorStateCast;
use Filament\Forms\Components\RichEditor;

class SafeRichEditor extends RichEditor
{
    public function getDefaultStateCasts(): array
    {
        return [
            app(SafeRichEditorStateCast::class, ['richEditor' => $this]),
        ];
    }
}
