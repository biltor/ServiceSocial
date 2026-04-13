<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MouvementBanqueResource\Pages;
use App\Filament\Resources\MouvementBanqueResource\RelationManagers;
use App\Models\mouvementBanque;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class MouvementBanqueResource extends Resource
{
    protected static ?string $model = mouvementBanque::class;

    protected static ?string $navigationIcon = 'heroicon-o-arrow-path';

    protected static ?string $navigationGroup = 'Comptabilité';

    protected static ?string $navigationLabel = 'Mouvements';


    public static function canCreate(): bool
    {
        return false;
    }

    public static function canEdit($record): bool
    {
        return false;
    }

    public static function canDelete($record): bool
    {
        return false;
    }


    public static function form(Form $form): Form
    {
        return $form
            ->schema([]);
    }

    public static function table(Table $table): Table
    {
        return $table
        ->headerActions([

            Tables\Actions\Action::make('releve')
                ->label('Relevé PDF')
                ->icon('heroicon-o-document-arrow-down')
                ->form([
                    \Filament\Forms\Components\DatePicker::make('date_debut')
                        ->label('Date début')
                        ->required(),

                    \Filament\Forms\Components\DatePicker::make('date_fin')
                        ->label('Date fin')
                        ->required(),
                ])
                ->action(function (array $data) {

                    return redirect()->route('releve.pdf', [
                        'from' => $data['date_debut'],
                        'to' => $data['date_fin'],
                    ]);
                })
                ->openUrlInNewTab(),

        ])
            ->columns([

                // Référence
                \Filament\Tables\Columns\TextColumn::make('reference')
                    ->label('Référence')
                    ->searchable()
                    ->sortable()
                    ->weight('bold'),

                //  Type (Débit / Crédit)
                \Filament\Tables\Columns\BadgeColumn::make('type')
                    ->label('Type')
                    ->colors([
                        'danger' => 'debit',
                        'success' => 'credit',
                    ])
                    ->icons([
                        'heroicon-o-arrow-down-circle' => 'debit',
                        'heroicon-o-arrow-up-circle' => 'credit',
                    ])

                    ->formatStateUsing(
                        fn($state) =>
                        $state === 'debit' ? 'Débit' : 'Crédit'
                    ),

                //  Montant
                \Filament\Tables\Columns\TextColumn::make('amount')
                    ->label('Montant')
                    ->money('DZD')
                    ->sortable(),

                //  Description
                \Filament\Tables\Columns\TextColumn::make('description')
                    ->label('Description')
                    ->limit(40)
                    ->tooltip(fn($record) => $record->description),

                //  Source (Crédit ou Virement)
                \Filament\Tables\Columns\TextColumn::make('source')
                    ->label('Source')
                    ->getStateUsing(function ($record) {
                        if ($record->credit_social_id) {
                            return 'Crédit';
                        }

                        if ($record->virement_id) {
                            return 'Virement';
                        }

                        return '-';
                    })
                    ->badge()
                    ->color(fn($state) => match ($state) {
                        'Crédit' => 'info',
                        'Virement' => 'warning',
                        default => 'gray',
                    }),

                //  Date
                \Filament\Tables\Columns\TextColumn::make('date')
                    ->label('Date')
                    ->date('d/m/Y')
                    ->sortable(),

                // SOLDE ( option PRO)
                \Filament\Tables\Columns\TextColumn::make('balance')
                    ->label('Solde')
                    ->money('DZD')
                    ->color(fn($state) => $state < 0 ? 'danger' : 'success')
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('type')
                    ->options([
                        'debit' => 'Débit',
                        'credit' => 'Crédit',
                    ]),
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
