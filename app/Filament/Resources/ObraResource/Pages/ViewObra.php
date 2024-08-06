<?php

namespace App\Filament\Resources\ObraResource\Pages;

use App\Filament\Resources\ObraResource;
use App\Models\Obra;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewObra extends ViewRecord
{
    protected static string $resource = ObraResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make()
                ->slideOver()
                ->form(Obra::getForm())
        ];
    }
}
