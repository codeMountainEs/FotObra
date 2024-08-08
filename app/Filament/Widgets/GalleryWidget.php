<?php

namespace App\Filament\Widgets;

use Filament\Widgets\Widget;

class GalleryWidget extends Widget
{
    protected int | string | array $columnSpan='full';
    protected static string $view = 'filament.widgets.gallery-widget';
}
