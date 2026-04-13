<?php

namespace App\Filament\Resources;

use App\Filament\Resources\VirementResource\Pages;
use App\Filament\Resources\VirementResource\RelationManagers;
use App\Models\Virement;
use App\Models\virementbc;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class VirementResource extends Resource
{
    protected static ?string $model = virementbc::class;
    protected static ?string $navigationGroup = 'Comptabilité';

    protected static ?string $navigationLabel = 'Virement';
    protected static ?string $navigationIcon = 'heroicon-o-banknotes';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('unite_id')
                    ->label('Unité')
                    ->relationship('unite', 'name')
                    ->live()
                    ->required(),

                Forms\Components\TextInput::make('reference')
                    ->label('Référence virement')
                    ->required(),

                Forms\Components\TextInput::make('label')
                    ->label('Libellé')
                    ->required(),

                Forms\Components\TextInput::make('amount')
                    ->label('Montant')
                    ->numeric()
                    ->prefix('DA')
                    ->required(),
                Forms\Components\DatePicker::make('datevirement')
                    ->label('Date de Virement')
                    ->required(),

                Forms\Components\FileUpload::make('attachment')
                    ->label('Pièce jointe')
                    ->directory('credits')
                    ->acceptedFileTypes(['application/pdf', 'image/*'])
                    ->maxSize(2048)
                    ->previewable()
                    ->openable()
                    ->downloadable(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                \Filament\Tables\Columns\TextColumn::make('reference')
                    ->label('Référence'),

                \Filament\Tables\Columns\TextColumn::make('unite.name')
                    ->label('Unité'),
                \Filament\Tables\Columns\TextColumn::make('unite.activeBankAccount.n_compte')
                   ->label('Compte bancaire')
                   ->placeholder('Aucun compte'),

                \Filament\Tables\Columns\TextColumn::make('amount')
                    ->color('success')
                    ->money('DZD'),

                \Filament\Tables\Columns\TextColumn::make('created_at')
                    ->dateTime(),
                \Filament\Tables\Columns\IconColumn::make('attachment')
                    ->label('Fichier')
                    ->icon(fn($state) => $state ? 'heroicon-o-paper-clip' : 'heroicon-o-x-mark')
                    ->color(fn($state) => $state ? 'success' : 'gray')
                    ->url(
                        fn($record) => $record->attachment
                            ? asset('storage/' . $record->attachment)
                            : null
                    )
                    ->openUrlInNewTab()
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
            'index' => Pages\ListVirements::route('/'),
            'create' => Pages\CreateVirement::route('/create'),
            'edit' => Pages\EditVirement::route('/{record}/edit'),
        ];
    }
}
