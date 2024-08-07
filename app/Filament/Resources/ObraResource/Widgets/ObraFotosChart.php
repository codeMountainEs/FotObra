<?php

namespace App\Filament\Resources\ObraResource\Widgets;

use Filament\Widgets\ChartWidget;

class ObraFotosChart extends ChartWidget
{
    protected static ?string $heading = 'Chart';

    protected function getData(): array
    {
        return [
            //
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}
