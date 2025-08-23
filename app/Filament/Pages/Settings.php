<?php

namespace App\Filament\Pages;

use Carbon\Carbon;
use Filament\Forms\Components\DatePicker;
use Filament\Pages\Page;
use Filament\Actions\Action;

class Settings extends Page
{
    protected string $view = 'filament.pages.settings';

    protected function getHeaderActions(): array
    {
        return [
            Action::make('pilihTanggal')
                ->label('Pilih Tanggal')
                ->icon('heroicon-o-calendar')
                ->modalHeading('Pilih Tanggal')
                ->modalDescription('Pilih tanggal untuk melihat data')
                ->form([
                    DatePicker::make('tanggal')
                        ->label('Tanggal')
                        ->required()
                        ->native(false)
                        ->displayFormat('d/m/Y')
                ])
                ->action(function (array $data) {
                    $tanggal = $data['tanggal'];
                    $formattedDate = Carbon::parse($tanggal)->format('Y-m-d');
                    return redirect()->route('laporan.mutasi');
                })
        ];
    }
}
