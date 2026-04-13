<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DemandeCreditResource\Pages;
use App\Filament\Resources\DemandeCreditResource\RelationManagers;
use App\Models\demande_credits;
use App\Models\DemandeCredit;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\Placeholder;
use Illuminate\Support\HtmlString;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Grid;

class DemandeCreditResource extends Resource
{
    protected static ?string $model = demande_credits::class;

    protected static ?string $navigationGroup = 'Service Social';
    protected ?string $heading = 'Demande credit';
    protected static ?string $navigationLabel = 'Demande de crédit';

    protected static ?string $navigationIcon = 'heroicon-o-document-check';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([



                // HEADER
                Grid::make(2)->schema([

                    Forms\Components\TextInput::make('reference')
                        ->label('Référence')
                        ->disabled()
                        ->dehydrated(),

                ]),

                //  SECTION 1
                Section::make('Informations générales')
                    ->schema([

                        Grid::make(3)->schema([

                            Forms\Components\Select::make('employee_id')
                                ->label('Bénéficiaire')
                                ->relationship('employee', 'name')
                                ->getOptionLabelFromRecordUsing(function ($record) {
                                    return $record->matricule . ' - ' . $record->name . ' ' . $record->last_name;
                                })
                                ->searchable()
                                ->required(),

                            Forms\Components\Select::make('type_credit_id')
                                ->label('Type de crédit')
                                ->relationship(
                                    name: 'typeCredit',
                                    titleAttribute: 'title',
                                    modifyQueryUsing: fn($query) => $query->where('type', 'credit')
                                )
                                ->required(),

                            Forms\Components\TextInput::make('montant')
                                ->label('Montant Demander')
                                ->numeric()
                                ->prefix('DA')
                                ->required(),

                        ]),

                    ])
                    ->columns(1),

                // SECTION 2
                Section::make('Motif')
                    ->schema([

                        Forms\Components\Textarea::make('motif')
                            ->label('Motif de la demande')
                            ->rows(4)
                            ->required(),

                    ]),

                // SECTION 3
                Section::make('attachment')
                    ->schema([

                        Forms\Components\FileUpload::make('attachment')
                            ->label('Pièce jointe')
                            ->disk('public') // 🔥 IMPORTANT
                            ->directory('demande_credits')
                            ->visibility('public')
                            ->openable()
                            ->downloadable()
                            ->previewable()
                    ]),

                // SECTION 4
                Section::make('Notes internes')
                    ->schema([

                        Forms\Components\Textarea::make('note')
                            ->rows(3),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([

                \Filament\Tables\Columns\TextColumn::make('reference')
                    ->label('Référence')
                    ->searchable()
                    ->sortable()
                    ->weight('bold'),


                \Filament\Tables\Columns\TextColumn::make('employee.name')
                    ->label('Bénéficiaire')
                    ->formatStateUsing(
                        fn($record) =>
                        "{$record->employee?->matricule} - {$record->employee?->name} {$record->employee?->last_name}"
                    )
                    ->searchable(),

                \Filament\Tables\Columns\TextColumn::make('employee.unite.name')
                    ->label('Unité')
                    ->badge()
                    ->color('info'),


                \Filament\Tables\Columns\TextColumn::make('montant')
                    ->label('Montant')
                    ->money('DZD')
                    ->sortable(),


                \Filament\Tables\Columns\TextColumn::make('typeCredit.title')
                    ->label('Type')
                    ->badge()
                    ->color('gray'),


                \Filament\Tables\Columns\TextColumn::make('date_demande')
                    ->label('Date')
                    ->date('d/m/Y')
                    ->sortable(),

                \Filament\Tables\Columns\IconColumn::make('attachment')
                    ->label('Fichier')
                    ->icon(fn($state) => $state ? 'heroicon-o-paper-clip' : null)
                    ->url(
                        fn($record) => $record->attachment
                            ? asset('storage/' . $record->attachment)
                            : null
                    )
                    ->openUrlInNewTab(),


                \Filament\Tables\Columns\BadgeColumn::make('etat')
                    ->label('Statut')
                    ->colors([
                        'warning' => 'brouillon',
                        'success' => 'valide',
                        'danger' => 'refuse',
                    ])
                    ->formatStateUsing(fn($state) => match ($state) {
                        'brouillon' => 'Brouillon',
                        'valide' => 'Validé',
                        'refuse' => 'Refusé',
                    }),

            ])
            ->filters([
                Tables\Filters\SelectFilter::make('etat')
                    ->options([
                        'brouillon' => 'Brouillon',
                        'valide' => 'Validé',
                        'refuse' => 'Refusé',
                    ]),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\Action::make('valider')
                    ->label('Valider')
                    ->color('success')
                    ->visible(fn($record) => $record->etat === 'brouillon')
                    ->action(fn($record) => $record->update(['etat' => 'valide'])),

                Tables\Actions\Action::make('refuser')
                    ->label('Refuser')
                    ->color('danger')
                    ->visible(fn($record) => $record->etat === 'brouillon')
                    ->action(fn($record) => $record->update(['etat' => 'refuse'])),

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
            'index' => Pages\ListDemandeCredits::route('/'),
            'create' => Pages\CreateDemandeCredit::route('/create'),
            'edit' => Pages\EditDemandeCredit::route('/{record}/edit'),
        ];
    }
}
