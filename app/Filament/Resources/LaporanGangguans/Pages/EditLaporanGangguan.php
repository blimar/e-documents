<?php

namespace App\Filament\Resources\LaporanGangguans\Pages;

use App\Filament\Resources\LaporanGangguans\LaporanGangguanResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditLaporanGangguan extends EditRecord
{
    protected static string $resource = LaporanGangguanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}
