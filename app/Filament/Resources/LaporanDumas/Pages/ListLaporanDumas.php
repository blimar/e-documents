<?php

namespace App\Filament\Resources\LaporanDumas\Pages;

use App\Filament\Resources\LaporanDumas\LaporanDumasResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListLaporanDumas extends ListRecords
{
    protected static string $resource = LaporanDumasResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
