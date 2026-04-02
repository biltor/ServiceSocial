<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TypeCreditResource\Pages;
use App\Filament\Resources\TypeCreditResource\RelationManagers;
use App\Models\typecredit ;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class TypeCreditResource extends Resource
{
    protected static ?string $model = typecredit::class;


    protected static ?string $navigationGroup = 'Service Social';
    protected static ?string $navigationLabel = 'Types de credit';

    protected static ?string $navigationIcon = 'heroicon-o-bolt';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('type')
                    ->label('Type')
                    ->options([
                        'don' => 'Don',
                        'credit' => 'Crédit social',
                    ])
                    ->required(),

                Forms\Components\TextInput::make('title')
                    ->label('Titre')
                    ->required(),

                Forms\Components\Textarea::make('description')
                    ->label('Description'),

                Forms\Components\TextInput::make('max_amount')
                    ->label('Montant maximum')
                    ->numeric()
                    ->prefix('DA')
                    ->placeholder('Illimité si vide'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('type')
                    ->badge()
                    ->color(fn($state) => $state === 'don' ? 'success' : 'info'),

                Tables\Columns\TextColumn::make('title')
                    ->label('Titre'),

                Tables\Columns\TextColumn::make('max_amount')
                    ->label('Max')
                    ->money('DZD')
                    ->placeholder('Illimité'),
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
            'index' => Pages\ListTypeCredits::route('/'),
            'create' => Pages\CreateTypeCredit::route('/create'),
            'edit' => Pages\EditTypeCredit::route('/{record}/edit'),
        ];
    }
}
