<?php

namespace App\Filament\Resources\LaporanDumas\Pages;

use App\Filament\Resources\LaporanDumas\LaporanDumasResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditLaporanDumas extends EditRecord
{
    protected static string $resource = LaporanDumasResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}
