<?php

namespace App\Filament\Resources\UserResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Select;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ObrasRelationManager extends RelationManager
{
    protected static string $relationship = 'obras';


    public function isReadOnly(): bool
    {
        return false;
    }


    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Hidden::make('user_id')
                    ->default(auth()->id())
                    ->required(),


                Select::make('obra_id')
                    ->label('Obra')
                    ->relationship(name: 'nombre', titleAttribute: 'is_active')

                    ->searchable()
                    ->preload()
                    ->required()
                ,
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('nombre')
            ->columns([
                Tables\Columns\TextColumn::make('nombre'),
                Tables\Columns\IconColumn::make('is_active')
                    ->boolean(),

            ])
            ->filters([
                //
            ])
            ->headerActions([
                //Tables\Actions\CreateAction::make(),
                Tables\Actions\AttachAction::make()->label('Asignar Obras'),
            ])
            ->actions([
                //Tables\Actions\EditAction::make(),
               // Tables\Actions\DeleteAction::make(),
                Tables\Actions\DetachAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
