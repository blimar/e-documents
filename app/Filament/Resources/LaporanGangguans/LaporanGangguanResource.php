<?php

namespace App\Filament\Resources\LaporanGangguans;

use App\Filament\Resources\LaporanGangguans\Pages\CreateLaporanGangguan;
use App\Filament\Resources\LaporanGangguans\Pages\EditLaporanGangguan;
use App\Filament\Resources\LaporanGangguans\Pages\ListLaporanGangguans;
use App\Filament\Resources\LaporanGangguans\Pages\ViewLaporanGangguan;
use App\Filament\Resources\LaporanGangguans\Schemas\LaporanGangguanForm;
use App\Filament\Resources\LaporanGangguans\Schemas\LaporanGangguanInfolist;
use App\Filament\Resources\LaporanGangguans\Tables\LaporanGangguansTable;
use App\Models\LaporanGangguan;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class LaporanGangguanResource extends Resource
{
    protected static ?string $model = LaporanGangguan::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'lp_no';

    protected static ?string $modelLabel = 'Gangguan';

    protected static ?string $pluralModelLabel = 'Gangguan';

    protected static string|UnitEnum|null $navigationGroup = 'Laporan';

    public static function form(Schema $schema): Schema
    {
        return LaporanGangguanForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return LaporanGangguanInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return LaporanGangguansTable::configure($table);
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
            'index' => ListLaporanGangguans::route('/'),
            'create' => CreateLaporanGangguan::route('/create'),
            'view' => ViewLaporanGangguan::route('/{record}'),
            'edit' => EditLaporanGangguan::route('/{record}/edit'),
        ];
    }
}
