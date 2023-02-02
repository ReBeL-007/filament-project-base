<?php

namespace App\Filament\Resources\PopupResource\Pages;

use App\Filament\Resources\PopupResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManagePopups extends ManageRecords
{
    protected static string $resource = PopupResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
