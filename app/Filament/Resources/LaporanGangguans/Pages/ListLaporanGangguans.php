<?php

namespace App\Filament\Resources\LaporanGangguans\Pages;

use App\Filament\Resources\LaporanGangguans\LaporanGangguanResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListLaporanGangguans extends ListRecords
{
    protected static string $resource = LaporanGangguanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
