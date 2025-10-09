<?php

namespace App\Filament\Resources\ReactorResource\Pages;

use App\Filament\Resources\ReactorResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListReactors extends ListRecords
{
    protected static string $resource = ReactorResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
