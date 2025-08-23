<?php

namespace App\Filament\Resources\LaporanPolisis\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class LaporanPolisiInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('id')
                    ->label('ID'),
                TextEntry::make('lp_no'),
                TextEntry::make('nama_pelapor'),
                TextEntry::make('korban'),
                TextEntry::make('terlapor'),
                TextEntry::make('saksi'),
                TextEntry::make('pasal'),
                TextEntry::make('waktu_kejadian')
                    ->dateTime(),
                TextEntry::make('tempat_kejadian'),
                TextEntry::make('waktu_dilaporkan')
                    ->dateTime(),
                TextEntry::make('satker'),
                TextEntry::make('foto'),
                TextEntry::make('created_at')
                    ->dateTime(),
                TextEntry::make('updated_at')
                    ->dateTime(),
            ]);
    }
}
