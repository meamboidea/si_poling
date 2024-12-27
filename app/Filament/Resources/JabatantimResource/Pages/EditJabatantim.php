<?php

namespace App\Filament\Resources\JabatantimResource\Pages;

use App\Filament\Resources\JabatantimResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditJabatantim extends EditRecord
{
    protected static string $resource = JabatantimResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // Actions\DeleteAction::make(),
        ];
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
