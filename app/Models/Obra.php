<?php

namespace App\Models;

use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Image\Enums\Fit;
use Spatie\MediaLibrary\MediaCollections\Models\Media;


class Obra extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;

    protected $fillable = [
        'referencia',
        'nombre',
        'is_active',
        'localidad',
    ];

    public function fotos () : HasMany
    {
       return $this->hasMany(Foto::class);
    }

    public function registerMediaConversions(?Media $media = null): void
    {
        $this
            ->addMediaConversion('preview')
            ->fit(Fit::Contain, 300, 300)
            ->nonQueued();
    }

    public static function getForm(): array {
        return [
            Section::make('Obra')
                ->collapsible()
                ->description('Datos de la obra ')
                ->columns(2)
                ->schema([
                    TextInput::make('nombre')
                        ->required()
                        ->maxLength(255)
                        ->columnSpanFull(),
                    TextInput::make('referencia'),
                    TextInput::make('localidad'),

                ])->columns(2),
            ];
    }
}
