<?php

namespace App\Filament\Resources;

use App\Enums\BankType;
use App\Filament\Resources\BanckAccountResource\Pages;
use App\Filament\Resources\BanckAccountResource\RelationManagers;
use App\Models\bank_account;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class BanckAccountResource extends Resource
{
    protected static ?string $model = bank_account::class;

    protected static ?string $navigationGroup = 'Ressource Humaines';
    protected ?string $heading = 'Création Compte bancaire';
    

    protected static bool $shouldRegisterNavigation = false;


    protected static ?string $navigationLabel = 'Compte Bancaire';

    protected static ?string $navigationIcon = 'heroicon-o-credit-card';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([

                Forms\Components\Select::make('bank_name')
                    ->label('Banque')
                    ->options(\App\Enums\AlgerianBank::options())
                    ->searchable(),

                Forms\Components\TextInput::make('n_compte')
                    ->label('Numéro de compte')
                    ->required(),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([])
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
            'index' => Pages\ListBanckAccounts::route('/'),
            'create' => Pages\CreateBanckAccount::route('/create'),
            'edit' => Pages\EditBanckAccount::route('/{record}/edit'),
        ];
    }
}
