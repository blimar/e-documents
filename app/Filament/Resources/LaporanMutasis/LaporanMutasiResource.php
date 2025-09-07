<?php

namespace App\Filament\Resources\LaporanMutasis;

use App\Filament\Resources\LaporanMutasis\Pages\ManageLaporanMutasis;
use App\Models\LaporanMutasi;
use App\Models\MKelompok;
use BackedEnum;
use Carbon\Carbon;
use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\ToggleButtons;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Http;
use UnitEnum;

class LaporanMutasiResource extends Resource
{
    protected static ?string $model = LaporanMutasi::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'deskripsi';

    protected static ?string $modelLabel = 'Mutasi';

    protected static ?string $pluralModelLabel = 'Mutasi';

    protected static string|UnitEnum|null $navigationGroup = 'Laporan';

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Textarea::make('deskripsi')
                    ->required(),
                Textarea::make('ket')
                    ->nullable(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('deskripsi')
            ->query(
                LaporanMutasi::query()->latest('created_at')
            )
            ->columns([
                TextColumn::make('deskripsi')
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
            ])
            ->headerActions([
                Action::make('pilihTanggal')
                    ->label('Generate Laporan')
                    ->icon('heroicon-o-calendar')
                    ->modalHeading('Pilih Tanggal')
                    ->modalDescription('Pilih tanggal untuk melihat data')
                    ->modalWidth('sm')
                    ->form([
                        DatePicker::make('tanggal')
                            ->label('Tanggal')
                            ->required()
                            ->native(false)
                            ->displayFormat('d/m/Y'),
                        ToggleButtons::make('status')
                            ->required()
                            ->inline()
                            ->options([
                                'siang' => 'Siang',
                                'malam' => 'Malam',
                                'harian' => 'Harian'
                            ]),
                        Select::make('kelompok')
                            ->required()
                            ->label('Kelompok')
                            ->options(MKelompok::all()->pluck('nama', 'id'))
                            ->searchable(),
                    ])
                    ->action(function (array $data) {
                        $tanggal = $data['tanggal'];
                        $formattedDate = Carbon::parse($tanggal)->format('Y-m-d');
                        return redirect()->route('laporan.mutasi', [
                            'tanggal' => $formattedDate,
                            'status' => $data['status'],
                            'kelompok' => $data['kelompok']
                        ]);
                    })
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => ManageLaporanMutasis::route('/'),
        ];
    }
}
