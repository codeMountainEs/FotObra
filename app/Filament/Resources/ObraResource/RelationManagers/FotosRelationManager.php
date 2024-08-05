<?php

namespace App\Filament\Resources\ObraResource\RelationManagers;

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

    public function form(Form $form): Form
    {
        return $form
            ->schema([

                Forms\Components\Hidden::make('user_id')
                    ->default(auth()->id())
                    ->required(),

                Forms\Components\SpatieMediaLibraryFileUpload::make('fotos')
                    ->collection('fotos')
                    ->image()
                    ->multiple()
                    ->imageEditor()
                    ->imageResizeMode('cover')


                    ->directory('obras')
                    ->maxSize(1024*1024*10)
                    ->responsiveImages()
                    ->imageResizeMode('cover')
                    ->imageCropAspectRatio('16:9')
                    ->imageResizeTargetWidth('1280')
                    ->imageResizeTargetHeight('720')
                    ->panelLayout('grid')
                    ->previewable(true)
                    ->columnSpanFull()



                    ->reorderable(),

            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('nombre')
            ->columns([
                Tables\Columns\TextColumn::make('user.name'),

                Tables\Columns\SpatieMediaLibraryImageColumn::make('Fotos')
                    ->collection('fotos')
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
