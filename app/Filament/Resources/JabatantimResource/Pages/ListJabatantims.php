<?php

namespace App\Filament\Resources\JabatantimResource\Pages;

use App\Filament\Resources\JabatantimResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListJabatantims extends ListRecords
{
    protected static string $resource = JabatantimResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
