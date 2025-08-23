<?php

namespace App\Filament\Resources\LaporanDumas\Pages;

use App\Filament\Resources\LaporanDumas\LaporanDumasResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewLaporanDumas extends ViewRecord
{
    protected static string $resource = LaporanDumasResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
