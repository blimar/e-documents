<?php

namespace App\Filament\Resources\MPersonels;

use App\Filament\Resources\MPersonels\Pages\ManageMPersonels;
use App\Models\MPersonel;
use BackedEnum;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use UnitEnum;

class MPersonelResource extends Resource
{
    protected static ?string $model = MPersonel::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'nama';

    protected static ?string $modelLabel = 'Personel';

    protected static ?string $pluralModelLabel = 'Personel';

    protected static string|UnitEnum|null $navigationGroup = 'Master Data';

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('m_jabatan_id')
                    ->relationship('jabatan', 'nama')
                    ->required(),
                Select::make('m_pangkat_id')
                    ->relationship('pangkat', 'nama')
                    ->required(),
                Select::make('m_kelompok_id')
                    ->relationship('kelompok', 'nama')
                    ->required(),
                TextInput::make('nama')
                    ->required(),
                TextInput::make('nrp')
                    ->label('NRP')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('nama')
            ->columns([
                TextColumn::make('nama')
                    ->searchable(),
                TextColumn::make('jabatan.nama')
                    ->label('Jabatan')
                    ->searchable(),
                TextColumn::make('pangkat.nama')
                    ->label('Pangkat')
                    ->searchable(),
                TextColumn::make('kelompok.nama')
                    ->label('Kelompok')
                    ->searchable(),
                TextColumn::make('nrp')
                    ->label('NRP')
                    ->searchable(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
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
            'index' => ManageMPersonels::route('/'),
        ];
    }
}
