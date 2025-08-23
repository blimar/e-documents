<?php

namespace App\Filament\Resources\LaporanKehilangans\Pages;

use App\Filament\Resources\LaporanKehilangans\LaporanKehilanganResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListLaporanKehilangans extends ListRecords
{
    protected static string $resource = LaporanKehilanganResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
