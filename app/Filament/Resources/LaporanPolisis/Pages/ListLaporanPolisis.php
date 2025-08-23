<?php

namespace App\Filament\Resources\LaporanPolisis\Pages;

use App\Filament\Resources\LaporanPolisis\LaporanPolisiResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListLaporanPolisis extends ListRecords
{
    protected static string $resource = LaporanPolisiResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
