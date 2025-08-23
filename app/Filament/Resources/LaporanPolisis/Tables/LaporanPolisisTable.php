<?php

namespace App\Filament\Resources\LaporanPolisis\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class LaporanPolisisTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('lp_no')
                    ->label('LP No')
                    ->searchable(),
                TextColumn::make('nama_pelapor')
                    ->searchable(),
                TextColumn::make('waktu_kejadian')
                    ->dateTime()
                    ->sortable(),
                TextColumn::make('tempat_kejadian')
                    ->searchable(),
                TextColumn::make('waktu_dilaporkan')
                    ->dateTime()
                    ->sortable(),
                TextColumn::make('satker')
                    ->searchable(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
