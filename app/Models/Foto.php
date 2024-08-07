<?php

namespace App\Models;

use App\Models\Traits\Multitenantable;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Foto extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;
    use Multitenantable;




    protected $fillable = [
        'referencia',
        'nombre',
        'obra_id',
        'user_id',
        'is_active',
        'tipobra_id',
        'images'
    ];
    protected $casts = ['images' => 'array'];


    // Método para contar imágenes por post
    public function countImages()
    {
        return is_array($this->images) ? count($this->images) : 0;
    }

    // Método estático para contar el total de imágenes en todos los posts
    public static function countTotalImages()
    {
        $totalImages = 0;
        $obras = self::all();

        foreach ($obras as $obra) {
            $totalImages += $obra->countImages();
        }

        return $totalImages;
    }



    public function obra(): BelongsTo
    {
        return $this->belongsTo(Obra::class);
    }
    public function tipobra(): BelongsTo
    {
        return $this->belongsTo(Tipobra::class);
    }
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
   /* public function registerMediaConversions(?Media $media = null): void
    {
        $this
            ->addMediaConversion('preview')
            ->fit(Fit::Contain, 300, 300)
            ->nonQueued();

    }*/

    public function registerMediaCollections(): void
    {
       $this->addMediaCollection('obraCollection')
           ->useDisk('obradisk')

          // ->useFallbackPath(public_path('obras/demo.jpg'))
          //  ->useFallbackUrl('obras/demo.jpg')
           // ->withResponsiveImages()

           ;

    }

    public static function getForm(): array
    {
        return [
            Hidden::make('user_id')
                ->default(auth()->id())
                ->required(),

            Select::make('tipobra_id')
                ->label('Tipo de Obra')
                ->relationship('tipobra', 'nombre')
                ->default(1)
                ->required()
            ,

            Section::make('Imágenes del Trabajo')->schema([

                FileUpload::make('images')
                    ->directory('trabajos')
                    ->multiple()
                    ->maxFiles(5)
                    ->reorderable()
                    ->imageEditor()
                    ->imageResizeMode('cover')
                    ->imageCropAspectRatio('16:9')
                    ->imageResizeTargetWidth('1280')
                    ->imageResizeTargetHeight('720')
                    ->panelLayout('grid')
                    ->columnSpanFull()
                ,

            ])->columns(1),


         /*  SpatieMediaLibraryFileUpload::make('fotos')

               ->collection('obraCollection')
                ->image()
                ->multiple()
                ->imageEditor()
                ->imageResizeMode('cover')
               ->maxSize(1024*1024*10)
               ->responsiveImages()
                ->imageCropAspectRatio('16:9')
                ->imageResizeTargetWidth('1280')
                ->imageResizeTargetHeight('720')
                ->panelLayout('grid')
                ->previewable(true)
                ->columnSpanFull()
                ->reorderable(),
            */

        ];
    }
}
