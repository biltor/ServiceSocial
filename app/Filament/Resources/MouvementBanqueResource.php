<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MouvementBanqueResource\Pages;
use App\Filament\Resources\MouvementBanqueResource\RelationManagers;
use App\Models\MouvementBanque;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class MouvementBanqueResource extends Resource
{
    protected static ?string $model = MouvementBanque::class;

    protected static ?string $navigationIcon = 'heroicon-o-arrow-path';

    protected static ?string $navigationGroup = 'Comptabilité';

    protected static ?string $navigationLabel = 'Mouvements';


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
                //
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
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
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListMouvementBanques::route('/'),
            'create' => Pages\CreateMouvementBanque::route('/create'),
            'edit' => Pages\EditMouvementBanque::route('/{record}/edit'),
        ];
    }
}
