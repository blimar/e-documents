<?php

namespace App\Filament\Resources\LaporanPolisis;

use App\Filament\Resources\LaporanPolisis\Pages\ManageLaporanPolisis;
use App\Models\LaporanPolisi;
use BackedEnum;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\TimePicker;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\TextColumn;
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
        return $schema
            ->components([
                TextInput::make('lp_no')
                    ->required()
                    ->maxLength(255),
                TextInput::make('tindak_pidana')
                    ->required(),
                DatePicker::make('tanggal_kejadian')
                    ->required(),
                TextInput::make('tempat_kejadian')
                    ->required(),
                Textarea::make('korban')
                    ->required(),
                Textarea::make('terlapor')
                    ->required(),
                Textarea::make('saksi')
                    ->required(),
                TextInput::make('sttlp')
                    ->label('STTLP')
                    ->required(),
                Textarea::make('uraian')
                    ->required(),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('lp_no')
            ->columns([
                TextColumn::make('lp_no')
                    ->searchable(),
                TextColumn::make('created_at')
                    ->label('Created At')
                    ->dateTime()
                    ->searchable(),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => ManageLaporanPolisis::route('/'),
        ];
    }
}
