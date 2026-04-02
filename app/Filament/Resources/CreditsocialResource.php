<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CreditsocialResource\Pages;
use App\Filament\Resources\CreditsocialResource\RelationManagers;
use App\Models\creditsocial;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Grid;

class CreditsocialResource extends Resource
{
    protected static ?string $model = Creditsocial::class;

    protected static ?string $navigationGroup = 'Service Social';
    protected static ?string $navigationIcon = 'heroicon-o-ticket';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Grid::make(2)->schema([

                    // Demande de crédit
                    Forms\Components\Select::make('demande_credit_id')
                        ->label('Demande de crédit')
                        ->relationship('demandeCredit', 'reference')
                        ->searchable()
                        ->preload()
                        ->required()
                        ->live()
                        ->afterStateUpdated(function ($state, callable $set) {

                            $demande = \App\Models\demande_credits::find($state);

                            if ($demande) {
                                //  Auto remplir montant demandé
                                $set('amount_dema', $demande->montant);

                                //  Auto remplir employé
                                $set('employee_id', $demande->employee_id);
                                $set('type_credit_id', $demande->type_credit_id);
                                $employee = $demande->employee;
                                if ($employee) {
                                    $set('account_number', $employee->compte_bank);
                                }
                            }
                        }),

                    //  Employé (auto rempli mais modifiable si besoin)
                    Forms\Components\Select::make('employee_id')
                        ->label('Employé')
                        ->relationship('employee', 'name')
                        ->getOptionLabelFromRecordUsing(function ($record) {
                            return $record->matricule . ' - ' . $record->name . ' ' . $record->last_name;
                        })
                        ->searchable()
                        ->required(),

                    //  Type crédit
                    Forms\Components\Select::make('type_credit_id')
                        ->label('Type crédit')
                        ->relationship('typeCredit', 'title')
                        ->searchable()
                        ->preload(),

                    //  Montant demandé (readonly auto)
                    Forms\Components\TextInput::make('amount_dema')
                        ->label('Montant demandé')
                        ->numeric()
                        ->prefix('DZD')
                        ->readOnly()
                        ->required(),

                    //  Montant accordé
                    Forms\Components\TextInput::make('amount_accord')
                        ->label('Montant accordé')
                        ->numeric()
                        ->prefix('DZD')
                        ->required(),

                    //  Fournisseur
                    Forms\Components\TextInput::make('fournisseur')
                        ->label('Fournisseur'),

                    //  Date paiement
                    Forms\Components\DatePicker::make('date_amount')
                        ->label('Date paiement'),

                    //  Mode paiement
                    Forms\Components\Select::make('type_payment')
                        ->label('Mode paiement')
                        ->options([
                            'virement' => 'Virement',
                            'cheque' => 'Chèque',
                        ])
                        ->default('virement')
                        ->required(),

                    //  État
                    Forms\Components\Select::make('state')
                        ->label('État')
                        ->options([
                            'nouveau' => 'Nouveau',
                            'en progression' => 'En progression',
                            'terminer' => 'Terminé',
                        ])
                        ->default('nouveau')
                        ->required(),

                    //  Compte bancaire
                    Forms\Components\TextInput::make('account_number')
                        ->label('Numéro de compte')
                        ->readOnly(),
                ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('demandeCredit.reference')
                    ->label('Référence Demande')
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('employee.name')
                    ->label('Employé')
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('typeCredit.title')
                    ->label('Type Crédit')
                    ->sortable()
                    ->searchable()
                    ->toggleable(), // optionnel, peut masquer

                Tables\Columns\TextColumn::make('amount_dema')
                    ->label('Montant demandé')
                    ->money('DZD', true)
                    ->sortable(),

                Tables\Columns\TextColumn::make('amount_accord')
                    ->label('Montant accordé')
                    ->money('DZD', true)
                    ->sortable(),

                Tables\Columns\TextColumn::make('account_number')
                    ->label('Compte bancaire')
                    ->toggleable(),

                Tables\Columns\TextColumn::make('type_payment')
                    ->label('Mode paiement')
                    ->sortable(),

                Tables\Columns\TextColumn::make('state')
                    ->label('État')
                    ->sortable(),

                Tables\Columns\TextColumn::make('date_amount')
                    ->label('Date paiement')
                    ->date('d/m/Y')
                    ->sortable(),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Créé le')
                    ->date('d/m/Y H:i')
                    ->sortable(),
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
            'index' => Pages\ListCreditsocials::route('/'),
            'create' => Pages\CreateCreditsocial::route('/create'),
            'edit' => Pages\EditCreditsocial::route('/{record}/edit'),
        ];
    }
}
