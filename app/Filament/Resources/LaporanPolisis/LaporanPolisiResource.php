<?php

namespace App\Filament\Resources\LaporanPolisis;

use App\Filament\Resources\LaporanPolisis\Pages\CreateLaporanPolisi;
use App\Filament\Resources\LaporanPolisis\Pages\EditLaporanPolisi;
use App\Filament\Resources\LaporanPolisis\Pages\ListLaporanPolisis;
use App\Filament\Resources\LaporanPolisis\Pages\ViewLaporanPolisi;
use App\Filament\Resources\LaporanPolisis\Schemas\LaporanPolisiForm;
use App\Filament\Resources\LaporanPolisis\Schemas\LaporanPolisiInfolist;
use App\Filament\Resources\LaporanPolisis\Tables\LaporanPolisisTable;
use App\Models\LaporanPolisi;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class LaporanPolisiResource extends Resource
{
    protected static ?string $model = LaporanPolisi::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'lp_no';

    protected static ?string $modelLabel = 'Polisi';

    protected static ?string $pluralModelLabel = 'Polisi';

    protected static string|UnitEnum|null $navigationGroup = 'Laporan';


    public static function form(Schema $schema): Schema
    {
        return LaporanPolisiForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return LaporanPolisiInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return LaporanPolisisTable::configure($table);
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
            'index' => ListLaporanPolisis::route('/'),
            'create' => CreateLaporanPolisi::route('/create'),
            'view' => ViewLaporanPolisi::route('/{record}'),
            'edit' => EditLaporanPolisi::route('/{record}/edit'),
        ];
    }
}
