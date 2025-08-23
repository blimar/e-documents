<?php

namespace App\Filament\Resources\LaporanKehilangans\Pages;

use App\Filament\Resources\LaporanKehilangans\LaporanKehilanganResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditLaporanKehilangan extends EditRecord
{
    protected static string $resource = LaporanKehilanganResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}
