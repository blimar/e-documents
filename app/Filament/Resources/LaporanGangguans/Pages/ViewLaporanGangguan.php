<?php

namespace App\Filament\Resources\LaporanGangguans\Pages;

use App\Filament\Resources\LaporanGangguans\LaporanGangguanResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewLaporanGangguan extends ViewRecord
{
    protected static string $resource = LaporanGangguanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
