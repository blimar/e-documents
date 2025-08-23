<?php

namespace App\Filament\Resources\LaporanPolisis\Pages;

use App\Filament\Resources\LaporanPolisis\LaporanPolisiResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewLaporanPolisi extends ViewRecord
{
    protected static string $resource = LaporanPolisiResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
