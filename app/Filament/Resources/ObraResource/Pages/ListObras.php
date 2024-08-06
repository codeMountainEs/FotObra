<?php

namespace App\Filament\Resources\ObraResource\Pages;

use App\Filament\Resources\ObraResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListObras extends ListRecords
{
    protected static string $resource = ObraResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
