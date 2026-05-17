<?php

namespace App\Filament\Resources\MediaCategories;

use App\Filament\Resources\BaseResource;
use App\Filament\Resources\MediaCategories\Pages\CreateMediaCategory;
use App\Filament\Resources\MediaCategories\Pages\EditMediaCategory;
use App\Filament\Resources\MediaCategories\Pages\ListMediaCategories;
use App\Filament\Resources\MediaCategories\Schemas\MediaCategoryForm;
use App\Filament\Resources\MediaCategories\Tables\MediaCategoriesTable;
use App\Models\MediaCategory;
use BackedEnum;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class MediaCategoryResource extends BaseResource
{
    protected static ?string $model = MediaCategory::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedFolder;

    protected static ?string $navigationLabel = 'Media Categories';

    protected static UnitEnum|string|null $navigationGroup = 'Media Library';

    public static function shouldRegisterNavigation(): bool
    {
        return false;
    }

    public static function form(Schema $schema): Schema
    {
        return MediaCategoryForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return MediaCategoriesTable::configure($table);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListMediaCategories::route('/'),
            'create' => CreateMediaCategory::route('/create'),
            'edit' => EditMediaCategory::route('/{record}/edit'),
        ];
    }
}
