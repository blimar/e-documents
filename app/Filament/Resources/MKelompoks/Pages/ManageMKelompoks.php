<?php

namespace App\Filament\Resources\MKelompoks\Pages;

use App\Filament\Resources\MKelompoks\MKelompokResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ManageRecords;

class ManageMKelompoks extends ManageRecords
{
    protected static string $resource = MKelompokResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
