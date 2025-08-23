<?php

namespace App\Filament\Resources\LaporanMutasis\Pages;

use App\Filament\Resources\LaporanMutasis\LaporanMutasiResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ManageRecords;

class ManageLaporanMutasis extends ManageRecords
{
    protected static string $resource = LaporanMutasiResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
