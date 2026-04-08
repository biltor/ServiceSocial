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
use Filament\Forms\Components\Wizard;
use Filament\Forms\Components\Wizard\Step;
use Filament\Forms\Components\Section;
use Carbon\Carbon;
use Filament\Tables\Actions\Action;

class CreditsocialResource extends Resource
{
    protected static ?string $model = Creditsocial::class;

    protected static ?string $navigationGroup = 'Service Social';
    protected static ?string $navigationIcon = 'heroicon-o-ticket';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([

                Wizard::make([

                    // STEP 1 : Demande
                    Step::make('Demande')
                        ->schema([
                            Grid::make(2)->schema([

                                Select::make('demande_credit_id')
                                    ->label('Demande de crédit')
                                    ->relationship(
                                        'demandeCredit',
                                        'reference',
                                        fn($query) =>
                                        $query->where('etat', 'brouillon')
                                    )
                                    ->searchable()
                                    ->preload()
                                    ->required()
                                    ->live()
                                    ->afterStateUpdated(function ($state, callable $set) {

                                        $demande = \App\Models\demande_credits::find($state);

                                        if ($demande) {
                                            $set('amount_dema', $demande->montant);
                                            $set('employee_id', $demande->employee_id);
                                            $set('type_credit_id', $demande->type_credit_id);

                                            if ($demande->employee) {
                                                $set('account_number', $demande->employee->compte_bank);
                                            }
                                        }
                                    }),

                                Select::make('employee_id')
                                    ->label('Employé')
                                    ->relationship('employee', 'name')
                                    ->getOptionLabelFromRecordUsing(
                                        fn($record) =>
                                        $record->matricule . ' - ' . $record->name . ' ' . $record->last_name
                                    )

                                    ->required(),

                                TextInput::make('account_number')
                                    ->label('Compte bancaire')
                                    ->readOnly(),

                            ]),
                        ]),

                    //  STEP 2 : Crédit
                    Step::make('Détails Crédit')
                        ->schema([
                            Grid::make(2)->schema([

                                Select::make('type_credit_id')
                                    ->label('Type crédit')
                                    ->relationship('typeCredit', 'title')
                                    ->searchable()
                                    ->preload(),

                                TextInput::make('amount_dema')
                                    ->label('Montant demandé')
                                    ->numeric()
                                    ->prefix('DZD')
                                    ->readOnly(),

                                TextInput::make('amount_accord')
                                    ->label('Montant accordé')
                                    ->numeric()
                                    ->prefix('DZD')
                                    ->required()
                                    ->rule(function (callable $get) {
                                        return function ($attribute, $value, $fail) use ($get) {
                                            if ($value > $get('amount_dema')) {
                                                $fail('Le montant accordé ne peut pas dépasser le montant demandé.');
                                            }
                                        };
                                    }),

                            ]),
                        ]),

                    // STEP 3 : Paiement
                    Step::make('Paiement')
                        ->schema([
                            Grid::make(2)->schema([

                                Select::make('type_payment')
                                    ->label('Mode paiement')
                                    ->options([
                                        'virement' => 'Virement',
                                        'cheque' => 'Chèque',
                                    ])
                                    ->default('virement')
                                    ->required(),

                                TextInput::make('refpayement')
                                    ->label('N° virement / cheque'),

                            ]),
                        ]),

                    // STEP 4 : Validation (remplace state dropdown)
                    Step::make('Génération de contrat')
                        ->schema([

                            DatePicker::make('date_contrat')
                                ->label('Date contrat'),

                            TextInput::make('amout_retenu')
                                ->label('Montant de retenu /mois')
                                ->numeric()
                                ->prefix('DZD')
                                ->required(),

                            DatePicker::make('date_retenu')
                                ->label('Le premier mois du retenu')
                                ->required()
                                ->displayFormat('m/Y') // affichage mois/année
                                ->format('Y-m-d') // stockage DB
                                ->required()
                                ->default(now()->startOfMonth())
                                ->minDate(now()->subYears(10))
                                ->maxDate(now()->subMonth())
                                ->dehydrateStateUsing(function ($state) {
                                    return Carbon::parse($state)->startOfMonth()->format('Y-m-d');
                                })

                        ]),
                ])
                    ->columnSpanFull(),

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
                Tables\Columns\TextColumn::make('amount_accord')
                    ->label('Montant ')
                    ->money('DZD', true)
                    ->searchable()
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
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),

                Tables\Actions\Action::make('contrat')
                    ->label('Contrat_Fr')
                    ->icon('heroicon-o-printer')
                    ->color('success')
                    ->url(fn($record) => route('contrat.pdf', $record->id))
                    ->openUrlInNewTab(),

                Tables\Actions\Action::make('pdf_ar')
                    ->label('Contrat_AR')
                    ->icon('heroicon-o-language')
                    ->url(fn($record) => route('contrat.ar', $record->id))
                    ->openUrlInNewTab(),
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
