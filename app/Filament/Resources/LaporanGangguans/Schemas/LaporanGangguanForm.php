<?php

namespace App\Filament\Resources\LaporanGangguans\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class LaporanGangguanForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('lp_no')
                    ->label('LP No')
                    ->required(),
                TextInput::make('nama_pelapor')
                    ->required(),
                Textarea::make('korban')
                    ->required(),
                Textarea::make('terlapor')
                    ->required(),
                Textarea::make('saksi')
                    ->required(),
                TextInput::make('pasal')
                    ->required(),
                Textarea::make('barang_bukti')
                    ->required()
                    ->columnSpanFull(),
                Textarea::make('uraian_kejadian')
                    ->required()
                    ->columnSpanFull(),
                DateTimePicker::make('waktu_kejadian')
                    ->required(),
                TextInput::make('tempat_kejadian')
                    ->required(),
                DateTimePicker::make('waktu_dilaporkan')
                    ->required(),
                TextInput::make('satker')
                    ->required(),
                FileUpload::make('foto')
                    ->image()
                    ->columnSpanFull()
                    ->directory('polisi')
                    ->visibility('public'),
            ]);
    }
}
