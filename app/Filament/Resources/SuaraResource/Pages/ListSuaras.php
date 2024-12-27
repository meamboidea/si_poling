<?php

namespace App\Filament\Resources\SuaraResource\Pages;

use App\Filament\Resources\SuaraResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListSuaras extends ListRecords
{
    protected static string $resource = SuaraResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
