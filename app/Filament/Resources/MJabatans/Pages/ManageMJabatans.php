<?php

namespace App\Filament\Resources\MJabatans\Pages;

use App\Filament\Resources\MJabatans\MJabatanResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ManageRecords;

class ManageMJabatans extends ManageRecords
{
    protected static string $resource = MJabatanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
