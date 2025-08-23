<?php

namespace App\Filament\Resources\MPangkats\Pages;

use App\Filament\Resources\MPangkats\MPangkatResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ManageRecords;

class ManageMPangkats extends ManageRecords
{
    protected static string $resource = MPangkatResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
