<?php

namespace App\Filament\Resources\ObraResource\Pages;

use App\Filament\Resources\ObraResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Filament\Resources\Components\Tab;
use Illuminate\Database\Eloquent\Builder;


class ListObras extends ListRecords
{
    protected static string $resource = ObraResource::class;


    public function getTabs(): array
    {
        return [
            'Todas' => Tab::make(),
            'Activas' => Tab::make()
                ->modifyQueryUsing(fn(Builder $query) => $query->where('is_active', true)),
            'Inactivas' => Tab::make()
                ->modifyQueryUsing(fn(Builder $query) => $query->where('is_active', false)),
        ];
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    protected function getHeaderWidgets(): array
    {
        return [
          ObraResource\Widgets\FotoObrasStatsWidget::class,
        ];
    }
}
