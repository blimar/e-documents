<?php

namespace App\Filament\Resources\LaporanKehilangans\Pages;

use App\Filament\Resources\LaporanKehilangans\LaporanKehilanganResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewLaporanKehilangan extends ViewRecord
{
    protected static string $resource = LaporanKehilanganResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
