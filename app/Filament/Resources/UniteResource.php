<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UniteResource\Pages;
use App\Filament\Resources\UniteResource\RelationManagers;
use App\Models\unite;
use App\wilyas;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class UniteResource extends Resource
{
    protected static ?string $model = unite::class;


    protected static ?string $navigationGroup = 'Ressource Humaines';
    protected static ?string $navigationIcon = 'heroicon-o-building-office';

    public static function form(Form $form): Form
    {
        return $form->schema([

            Forms\Components\Tabs::make('Unite Tabs')
                ->tabs([

                    //  ONGLET 1 : Informations générales
                    Forms\Components\Tabs\Tab::make('Informations')
                        ->icon('heroicon-o-building-office')
                        ->schema([

                            Forms\Components\Grid::make(2)->schema([

                                Forms\Components\TextInput::make('name')
                                    ->label('Nom de l’unité')
                                    ->required()
                                    ->maxLength(255),

                                Forms\Components\TextInput::make('email')
                                    ->email()
                                    ->required(),

                            ]),

                            Forms\Components\Select::make('wilaya')
                                ->label('Wilayas')
                                ->options(\App\Enums\wilyas::options())
                                ->searchable()
                                ->required(),

                        ]),

                    //  ONGLET 2 : Comptes bancaires
                    Forms\Components\Tabs\Tab::make('Comptes bancaires')
                        ->icon('heroicon-o-credit-card')
                        ->schema([

                            Forms\Components\Repeater::make('bankAccounts')
                                ->relationship()
                                ->label('Comptes')
                                ->schema([

                                    Forms\Components\Select::make('bank_name')
                                        ->label('Banque')
                                        ->options(\App\Enums\AlgerianBank::options())
                                        ->searchable()
                                        ->required(),

                                    Forms\Components\TextInput::make('n_compte')
                                        ->label('Numéro de compte')
                                        ->required(),

                                    Forms\Components\Toggle::make('is_active')
                                        ->label('Actif')
                                        ->default(false)
                                        ->reactive()
                                        ->afterStateUpdated(function ($state, $set, $get) {
                                            if ($state) {
                                                $items = $get('../../bankAccounts') ?? [];

                                                foreach ($items as $index => $item) {
                                                    $set("../../bankAccounts.$index.is_active", false);
                                                }
                                                $set('is_active', true);
                                            }
                                        }),

                                ])
                                ->columns(3)
                                ->defaultItems(1)
                                ->createItemButtonLabel('Ajouter un compte')
                                ->collapsible(),

                        ]),

                ])
                ->columnSpanFull(),

        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Unité')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('email')
                    ->label('Email')
                    ->copyable()
                    ->icon('heroicon-o-envelope')
                    ->limit(30),

                Tables\Columns\TextColumn::make('wilaya')
                    ->label('Wilaya')
                    ->badge()
                    ->color('info'),

                Tables\Columns\TextColumn::make('activeBankAccount.n_compte')
                    ->label('Compte actif')
                    ->placeholder('—')
                    ->icon('heroicon-o-credit-card'),


                Tables\Columns\TextColumn::make('activeBankAccount.bank_name')
                    ->label('Banque')
                    ->badge()
                    ->color('success')
                    ->placeholder('—'),


                Tables\Columns\TextColumn::make('bank_accounts_count')
                    ->counts('bankAccounts')
                    ->label('Comptes')
                    ->badge()
                    ->color('warning'),


                Tables\Columns\TextColumn::make('created_at')
                    ->label('Créé le')
                    ->date()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
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
            'index' => Pages\ListUnites::route('/'),
            'create' => Pages\CreateUnite::route('/create'),
            'edit' => Pages\EditUnite::route('/{record}/edit'),
        ];
    }
}
