<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ContratResource\Pages;
use App\Filament\Resources\ContratResource\RelationManagers;
use App\Models\Contrat;
use App\Models\contrats;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ContratResource extends Resource
{
    protected static ?string $model = contrats::class;
      protected static ?string $navigationGroup = 'Service Social';

    protected static ?string $navigationIcon = 'heroicon-o-link';
    public static function canCreate(): bool
    {
        return false;
    }

    public static function canEdit($record): bool
    {        return false;    }

    public static function canDelete($record): bool
    {
        return false;
    }
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                


            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('reference')->label('Ref'),
                Tables\Columns\TextColumn::make('employee.name')->label('Employé'),
                Tables\Columns\TextColumn::make('type')->label('Type'),
                Tables\Columns\TextColumn::make('amount')
                ->label('Montant accordé')
                ->money('DZD'),
                Tables\Columns\TextColumn::make('amount_retenu')
                ->label('Montant Retenu/mois')
                ->money('DZD'),
                Tables\Columns\TextColumn::make('start_date')->date(),
                Tables\Columns\TextColumn::make('end_date')->date(),
                Tables\Columns\IconColumn::make('state'),
            ])
            ->filters([
                //
            ])
            ->actions([
                 Tables\Actions\ViewAction::make(), 
            ])
            ->bulkActions([
/*                 Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]), */
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
            'index' => Pages\ListContrats::route('/'),
            //'create' => Pages\CreateContrat::route('/create'),
            //'edit' => Pages\EditContrat::route('/{record}/edit'),
        ];
    }
}
