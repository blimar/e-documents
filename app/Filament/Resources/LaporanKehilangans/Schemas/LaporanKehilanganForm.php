<?php

namespace App\Filament\Resources\LaporanKehilangans\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class LaporanKehilanganForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('no')
                    ->required(),
                Textarea::make('keterangan')
                    ->required()
                    ->columnSpanFull(),
                DateTimePicker::make('waktu_dilaporkan')
                    ->required(),
                FileUpload::make('foto')
                    ->image()
                    ->directory('kehilangan')
                    ->visibility('public'),
            ]);
    }
}
