<?php

namespace App\Filament\Resources\ObraResource\Widgets;

use App\Filament\Resources\ObraResource\Pages\ListObras;
use App\Models\Foto;
use App\Models\Obra;
use Filament\Widgets\Concerns\InteractsWithPageTable;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class FotoObrasStatsWidget extends BaseWidget
{

    use InteractsWithPageTable;

    protected function getTablePage(): string
    {
       return ListObras::class;
    }

    protected function getColumns(): int
    {
        return 2;
    }

    protected function getStats(): array
    {

       /* $totalFotos = Obra::sum(function ($query){
            return count(json_decode($query->images));
        });*/
        $totalFotos = Foto::countTotalImages();
        //$totalFotos = $this->getPageTableQuery()->


        return [
            Stat::make('Obras', Obra::where('is_active',true)->count())
            ->description('Total Obras activas')
            ->descriptionIcon('heroicon-o-user-group')
            ->color('success')
            ->chart([1,2,3,4,5,1,1])
            ,

            Stat::make('Total Fotos',$totalFotos),

        ];
    }
}
