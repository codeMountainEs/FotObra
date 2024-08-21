<?php

namespace App\Filament\Resources\FotoResource\Pages;

use App\Filament\Resources\FotoResource;
use App\Models\Foto;
use App\Models\Tipobra;
use Filament\Actions;
use Filament\Resources\Components\Tab;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;

class ListFotos extends ListRecords
{
    protected static string $resource = FotoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            //Actions\CreateAction::make(),
        ];
    }

    public function getTabs(): array
    {
        //$opciones = ['General','Ejecución','Finalización', 'Planteamiento'];
        $tabs['all'] = Tab::make('Todas las Fotos')->badge(Foto::count());
        $tiposObra = Tipobra::orderBy('id')->withCount('fotos')->get();



        foreach ($tiposObra as $tipobra) {
            if($tipobra->fotos_count > 0){
                $tabs[str($tipobra->nombre)->slug()->toString()] = Tab::make($tipobra->nombre)
                    ->badge($tipobra->fotos_count)
                    ->modifyQueryUsing(function ($query) use ($tipobra){
                        // dd($tiposObra->pluck('id'));
                        return $query->where('tipobra_id', $tipobra->id);
                    });
            }


        }
        return $tabs;
        /*return [
            'all' => Tab::make(),
            'active' => Tab::make()->modifyQueryUsing(fn (Builder $query) => $query->where('active', true)),
        ];*/
    }
}
