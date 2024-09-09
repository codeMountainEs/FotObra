<?php

namespace App\Models;

use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Tables\Columns\IconColumn;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
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




    public function is_active()
    {
        return $this->is_active = true;
    }

    public function getNumeroDeFotos()
    {
        return count(json_decode($this->images));
    }

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
                ->description('Datos de la Obra ')
                ->schema([
                    TextInput::make('nombre')
                        ->required()
                        ->maxLength(255)
                        ->columnSpanFull(),
                    TextInput::make('referencia'),
                    TextInput::make('localidad'),
                    Toggle::make('is_active'),



                ])->columns(3),
            ];
    }

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class);
    }


 protected static function booted(): void
    {
        $user = auth()->user();
        $obras = $user->obras()->get();

        if(auth()->user()){
//dd(auth()->user()->role_id);

            if (auth()->user()->role_id ===3 ) {
                static::addGlobalScope('obra', function (Builder $query)  use ($user,$obras) {
                    $query->whereRelation('users', 'user_id', '=', $user->id);
                    // ->orWhere('public', true);
                });
            }
        }


    }



   /* public function scopeForUser(Builder $query, User $user)
    {
        dd('spcope', $user);
        return $query->whereHas('users', function ($query) use ($user) {
            $query->where('users.id', $user->id);
        });
    }
   */

}
