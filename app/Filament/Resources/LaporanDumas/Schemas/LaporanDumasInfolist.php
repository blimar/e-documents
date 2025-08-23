<?php

namespace App\Filament\Resources\LaporanDumas\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class LaporanDumasInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('id')
                    ->label('ID'),
                TextEntry::make('no'),
                TextEntry::make('nama_pengadu'),
                TextEntry::make('nama_teradu'),
                TextEntry::make('satker'),
                TextEntry::make('foto'),
                TextEntry::make('waktu_dilaporkan')
                    ->dateTime(),
                TextEntry::make('created_at')
                    ->dateTime(),
                TextEntry::make('updated_at')
                    ->dateTime(),
            ]);
    }
}
