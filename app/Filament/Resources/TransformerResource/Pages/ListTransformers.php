<?php

namespace App\Filament\Resources\TransformerResource\Pages;

use App\Filament\Resources\TransformerResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListTransformers extends ListRecords
{
    protected static string $resource = TransformerResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
