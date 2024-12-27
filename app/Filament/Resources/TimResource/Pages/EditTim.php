<?php

namespace App\Filament\Resources\TimResource\Pages;

use App\Filament\Resources\TimResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditTim extends EditRecord
{
    protected static string $resource = TimResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
