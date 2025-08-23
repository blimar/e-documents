<?php

namespace App\Filament\Resources\LaporanDumas\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class LaporanDumasForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('no')
                    ->required(),
                TextInput::make('nama_pengadu')
                    ->required(),
                TextInput::make('nama_teradu')
                    ->required(),
                Textarea::make('kronologi')
                    ->required()
                    ->columnSpanFull(),
                Textarea::make('barang_bukti')
                    ->required()
                    ->columnSpanFull(),
                Textarea::make('modus')
                    ->required()
                    ->columnSpanFull(),
                TextInput::make('satker')
                    ->required(),
                DateTimePicker::make('waktu_dilaporkan')
                    ->required(),
                FileUpload::make('foto')
                    ->image()
                    ->directory('dumas')
                    ->visibility('public'),

            ]);
    }
}
