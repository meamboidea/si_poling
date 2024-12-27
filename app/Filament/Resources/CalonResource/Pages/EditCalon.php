<?php

namespace App\Filament\Resources\CalonResource\Pages;

use App\Filament\Resources\CalonResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditCalon extends EditRecord
{
    protected static string $resource = CalonResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
