<?php

namespace App\Filament\Resources\PavingResource\Pages;

use App\Filament\Resources\PavingResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPaving extends EditRecord
{
    protected static string $resource = PavingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
