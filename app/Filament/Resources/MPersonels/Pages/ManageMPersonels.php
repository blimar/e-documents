<?php

namespace App\Filament\Resources\MPersonels\Pages;

use App\Filament\Resources\MPersonels\MPersonelResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ManageRecords;

class ManageMPersonels extends ManageRecords
{
    protected static string $resource = MPersonelResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
