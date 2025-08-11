<?php

namespace App\Filament\Resources\TransformerResource\Pages;

use App\Filament\Resources\TransformerResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditTransformer extends EditRecord
{
    protected static string $resource = TransformerResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
