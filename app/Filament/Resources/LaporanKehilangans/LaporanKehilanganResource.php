<?php

namespace App\Filament\Resources\LaporanKehilangans;

use App\Filament\Resources\LaporanKehilangans\Pages\CreateLaporanKehilangan;
use App\Filament\Resources\LaporanKehilangans\Pages\EditLaporanKehilangan;
use App\Filament\Resources\LaporanKehilangans\Pages\ListLaporanKehilangans;
use App\Filament\Resources\LaporanKehilangans\Pages\ViewLaporanKehilangan;
use App\Filament\Resources\LaporanKehilangans\Schemas\LaporanKehilanganForm;
use App\Filament\Resources\LaporanKehilangans\Schemas\LaporanKehilanganInfolist;
use App\Filament\Resources\LaporanKehilangans\Tables\LaporanKehilangansTable;
use App\Models\LaporanKehilangan;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class LaporanKehilanganResource extends Resource
{
    protected static ?string $model = LaporanKehilangan::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'no';

    protected static ?string $modelLabel = 'Kehilangan';

    protected static ?string $pluralModelLabel = 'Kehilangan';

    protected static string|UnitEnum|null $navigationGroup = 'Laporan';

    public static function form(Schema $schema): Schema
    {
        return LaporanKehilanganForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return LaporanKehilanganInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return LaporanKehilangansTable::configure($table);
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
            'index' => ListLaporanKehilangans::route('/'),
            'create' => CreateLaporanKehilangan::route('/create'),
            'view' => ViewLaporanKehilangan::route('/{record}'),
            'edit' => EditLaporanKehilangan::route('/{record}/edit'),
        ];
    }
}
