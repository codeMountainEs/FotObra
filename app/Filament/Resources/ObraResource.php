<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ObraResource\Pages;
use App\Filament\Resources\ObraResource\RelationManagers;
use App\Models\Obra;
use Filament\Actions\ViewAction;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ObraResource extends Resource
{
    protected static ?string $model = Obra::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Obra')
                    ->collapsible()
                    ->description('Datos de la obra ')
                    ->columns(2)
                    ->schema([
                        Forms\Components\TextInput::make('nombre')
                            ->required()
                            ->maxLength(255)
                            ->columnSpanFull(),
                        Forms\Components\TextInput::make('referencia'),
                        Forms\Components\TextInput::make('localidad'),



                    ])



               // Forms\Components\SpatieMediaLibraryFileUpload::make('avatar')

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([

                Tables\Columns\TextColumn::make('nombre')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('localidad')
                    ->searchable()
                    ->sortable(),

            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make()
                ->slideOver(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            RelationManagers\FotosRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListObras::route('/'),
            'create' => Pages\CreateObra::route('/create'),
            'edit' => Pages\EditObra::route('/{record}/edit'),
        ];
    }
}
