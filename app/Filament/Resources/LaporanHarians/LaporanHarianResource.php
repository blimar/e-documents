<?php

namespace App\Filament\Resources\LaporanHarians;

use App\Filament\Resources\LaporanHarians\Pages\ManageLaporanHarians;
use App\Models\LaporanHarian;
use App\Models\MKelompok;
use App\Models\MPersonel;
use BackedEnum;
use Carbon\Carbon;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Actions\Action;
use UnitEnum;

class LaporanHarianResource extends Resource
{
    protected static ?string $model = LaporanHarian::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'keterangan';

    protected static ?string $modelLabel = 'Harian';

    protected static ?string $pluralModelLabel = 'Harian';

    protected static string|UnitEnum|null $navigationGroup = 'Laporan';

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Textarea::make('keterangan')
                    ->required()
                    ->columnSpanFull(),
                FileUpload::make('image')
                    ->image()
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('keterangan')
            ->columns([
                TextColumn::make('keterangan')
                    ->label('Keterangan')
                    ->searchable(),
                ImageColumn::make('image'),
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
            ])->headerActions([
                    Action::make('pilihTanggal')
                        ->label('Generate Laporan')
                        ->icon('heroicon-o-calendar')
                        ->modalHeading('Pilih Tanggal')
                        ->modalDescription('Pilih tanggal untuk melihat data')
                        ->modalWidth('sm')
                        ->form([
                            TextInput::make('lp_no')
                                ->label('No Laporan')
                                ->required(),
                            DatePicker::make('tanggal')
                                ->label('Tanggal')
                                ->required()
                                ->native(false)
                                ->displayFormat('d/m/Y'),
                            Select::make('kelompok_id')
                                ->label('Kelompok')
                                ->options(MKelompok::pluck('nama', 'id'))
                                ->searchable()
                                ->required(),
                            Select::make('personel_id')
                                ->label('Ketua Kelompok')
                                ->options(function (callable $get) {
                                    $kelompokId = $get('kelompok_id'); // ambil value dari field pertama

                                    if (!$kelompokId) {
                                        return [];
                                    }

                                    return MPersonel::where('m_kelompok_id', $kelompokId)
                                        ->pluck('nama', 'id');
                                })
                                ->searchable()
                                ->required(),
                        ])
                        ->action(function (array $data) {
                            $tanggal = $data['tanggal'];

                            $formattedDate = Carbon::parse($tanggal)->format('Y-m-d');

                            $data[] = [
                                'formattedDate' => $formattedDate
                            ];


                        // return redirect()->route('laporan.harian', [
                        //         'tanggal' => $formattedDate,
                        //         'kelompok_id' => $data['kelompok_id'],
                        //         'personel_id' => $data['personel_id'],
                        //         'lp_no' => $data['lp_no']
                        //     ]);
                            request()->merge($data);
                            return app(\App\Http\Controllers\DocController::class)->generate(request());
                        })
                ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => ManageLaporanHarians::route('/'),
        ];
    }
}
