<?php

namespace App\Filament\Resources\ReactorResource\Pages;

use App\Filament\Resources\ReactorResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditReactor extends EditRecord
{
    protected static string $resource = ReactorResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
