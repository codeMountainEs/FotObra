<?php

namespace App\Filament\Resources;

use App\Filament\Resources\FotoResource\Pages;
use App\Filament\Resources\FotoResource\RelationManagers;
use App\Models\Foto;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Filament\Support\Enums\FontWeight;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class FotoResource extends Resource
{
    protected static ?string $model = Foto::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([

                Tables\Columns\Layout\Stack::make([

                    Tables\Columns\ImageColumn::make('images')
                        ->wrap()
                        ->stacked()
                    ->height('100%')
                    ->width('100%')
                   ,
                    Tables\Columns\Layout\Stack::make([
                        Tables\Columns\TextColumn::make('nombre')
                        ->weight(FontWeight::Bold),
                        Tables\Columns\TextColumn::make('referencia'),
                        Tables\Columns\TextColumn::make('obra.nombre')

                    ])
                ])->space(3)
            ])
            ->filters([
                //
            ])
            ->contentGrid([
                'md' => 2,
                'xl' => 3,
            ])
            ->paginated([
                18,36,72,'all',
            ])
            ->defaultSort('updated_at','desc')
            ->actions([
                Tables\Actions\ViewAction::make(),
                //Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }


    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                Section::make('Fotos de la Obra')
                ->schema([
                    TextEntry::make('nombre'),
                    ImageEntry::make('images')->width('50%')
                ])
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListFotos::route('/'),
            //'create' => Pages\CreateFoto::route('/create'),
            'view' => Pages\ViewFotos::route('/{record}'),
            'edit' => Pages\EditFoto::route('/{record}/edit'),
        ];
    }
}
