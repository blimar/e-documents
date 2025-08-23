<?php

namespace App\Filament\Resources\LaporanPolisis\Pages;

use App\Filament\Resources\LaporanPolisis\LaporanPolisiResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditLaporanPolisi extends EditRecord
{
    protected static string $resource = LaporanPolisiResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}
