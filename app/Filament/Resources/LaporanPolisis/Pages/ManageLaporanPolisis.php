<?php

namespace App\Filament\Resources\LaporanPolisis\Pages;

use App\Filament\Resources\LaporanPolisis\LaporanPolisiResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ManageRecords;

class ManageLaporanPolisis extends ManageRecords
{
    protected static string $resource = LaporanPolisiResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
