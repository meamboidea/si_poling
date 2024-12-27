<?php

namespace App\Filament\Resources\UserResource\Pages;

use Filament\Actions;
use Spatie\Permission\Models\Role;
use App\Filament\Resources\UserResource;
use Filament\Resources\Pages\CreateRecord;

class CreateUser extends CreateRecord
{
    protected static string $resource = UserResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }



    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $role = Role::find($this->data['roles'][0]);
        $roleName = $role->name;

        $data['role'] = $roleName;

        return $data;
    }

}
