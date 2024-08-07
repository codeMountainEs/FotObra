<?php

namespace App\Filament\Resources\ObraResource\RelationManagers;

use App\Models\Foto;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
class FotosRelationManager extends RelationManager
{
    protected static string $relationship = 'fotos';

    public function isReadOnly(): bool
    {
        //return parent::isReadOnly(); // TODO: Change the autogenerated stub
        return false;
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema(
                Foto::getForm(),
            );
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('nombre')
            ->columns([
                Tables\Columns\TextColumn::make('user.name'),
                Tables\Columns\TextColumn::make('tipobra.nombre')->label('Tipo de Obra'),
                Tables\Columns\ImageColumn::make('images')

                    ->stacked()
                    ->limit(3)
                    ->label('Imagen'),

                Tables\Columns\SpatieMediaLibraryImageColumn::make('Fotos')
                    ->collection('obraCollection')
                    ->circular()
                    ->stacked()
                    ->limit(3)
                    ->limitedRemainingText()


                ,

                    Tables\Columns\TextColumn::make('updated_at')
                        ->dateTime()
                        ->sortable()


            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make()->slideOver(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
