<?php

namespace App\Filament\Resources\JabatantimResource\Pages;

use App\Filament\Resources\JabatantimResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateJabatantim extends CreateRecord
{
    protected static string $resource = JabatantimResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
