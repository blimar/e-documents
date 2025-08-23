<?php

namespace App\Filament\Resources\LaporanDumas;

use App\Filament\Resources\LaporanDumas\Pages\CreateLaporanDumas;
use App\Filament\Resources\LaporanDumas\Pages\EditLaporanDumas;
use App\Filament\Resources\LaporanDumas\Pages\ListLaporanDumas;
use App\Filament\Resources\LaporanDumas\Pages\ViewLaporanDumas;
use App\Filament\Resources\LaporanDumas\Schemas\LaporanDumasForm;
use App\Filament\Resources\LaporanDumas\Schemas\LaporanDumasInfolist;
use App\Filament\Resources\LaporanDumas\Tables\LaporanDumasTable;
use App\Models\LaporanDumas;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class LaporanDumasResource extends Resource
{
    protected static ?string $model = LaporanDumas::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'no';

    protected static ?string $modelLabel = 'Dumas';

    protected static ?string $pluralModelLabel = 'Dumas';

    protected static string|UnitEnum|null $navigationGroup = 'Laporan';

    public static function form(Schema $schema): Schema
    {
        return LaporanDumasForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return LaporanDumasInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return LaporanDumasTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListLaporanDumas::route('/'),
            'create' => CreateLaporanDumas::route('/create'),
            'view' => ViewLaporanDumas::route('/{record}'),
            'edit' => EditLaporanDumas::route('/{record}/edit'),
        ];
    }
}
