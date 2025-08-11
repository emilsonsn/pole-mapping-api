<?php

namespace App\Filament\Resources\ConnectionTypeResource\Pages;

use App\Filament\Resources\ConnectionTypeResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditConnectionType extends EditRecord
{
    protected static string $resource = ConnectionTypeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
