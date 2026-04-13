<?php

namespace App\Filament\Resources;

use App\Filament\Resources\EmployeeResource\Pages;
use App\Filament\Resources\EmployeeResource\RelationManagers;
use App\Models\employee;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class EmployeeResource extends Resource
{
    protected static ?string $model = employee::class;

    protected static ?string $navigationGroup = 'Ressource Humaines';
    protected static ?string $navigationIcon = 'heroicon-o-users';

    protected ?string $heading = 'Création Employées';

    protected static ?string $navigationLabel = 'Employées';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                   Forms\Components\Tabs::make('Employee Tabs')
            ->tabs([

                //  Onglet 1 : Identité
                Forms\Components\Tabs\Tab::make('Informations Personnel')
                    ->icon('heroicon-o-user')
                    ->schema([

                        Forms\Components\Grid::make(3)->schema([

                            Forms\Components\TextInput::make('matricule')
                                ->numeric()
                                ->required()
                                ->unique(ignoreRecord: true),

                            Forms\Components\Select::make('sex')
                                ->options([
                                    'Homme' => 'Homme',
                                    'Femme' => 'Femme',
                                ])
                                ->required(),

                            Forms\Components\TextInput::make('nin')
                                ->label('NIN')
                                ->length(18)
                                ->required(),

                        ]),

                        Forms\Components\Grid::make(2)->schema([

                            Forms\Components\TextInput::make('name')
                                ->label('Nom')
                                ->required(),

                            Forms\Components\TextInput::make('last_name')
                                ->label('Prénom')
                                ->required(),

                        ]),

                        Forms\Components\Grid::make(2)->schema([

                            Forms\Components\TextInput::make('name_ar')
                                ->label('اللقب')
                                ->required(),

                            Forms\Components\TextInput::make('last_name_ar')
                                ->label('الإسم')
                                ->required(),
                            Forms\Components\DatePicker::make('datenais')
                                ->label('Date de naissance'),

                            Forms\Components\Select::make('lieux')
                                ->label('Lieux de naissance')
                                ->options(\App\Enums\wilyas::options())
                                ->searchable(),
                            

                        ]),

                    ]),

                //  Onglet 2 : Travail
                Forms\Components\Tabs\Tab::make('Professionnel')
                    ->icon('heroicon-o-building-office')
                    ->schema([

                        Forms\Components\Select::make('unite_id')
                            ->label('Unité')
                            ->relationship('unite', 'name')
                            ->searchable()
                            ->preload()
                            ->required(),

                        Forms\Components\TextInput::make('post')
                            ->label('Poste')
                            ->required(),

                    ]),

                //  Onglet 3 : Contact
                Forms\Components\Tabs\Tab::make('Contact')
                    ->icon('heroicon-o-phone')
                    ->schema([

                        Forms\Components\TextInput::make('tel')
                            ->tel()
                            ->prefix('+213')
                            ->required(),

                    ]),
                // ongle 4 comptabilité
                 Forms\Components\Tabs\Tab::make('Banque')
                          ->icon('heroicon-o-credit-card')
                          ->schema([
                        Forms\Components\Select::make('bank_name')
                            ->label('Banque')
                            ->options(\App\Enums\AlgerianBank::options())
                            ->searchable()
                           ->placeholder('Sélectionner une banque'),

                        Forms\Components\TextInput::make('compte_bank')
                            ->label('RIB')
                            ->required(),
            ]),

            ])
            ->columnSpanFull(),



            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                \Filament\Tables\Columns\TextColumn::make('matricule')
                    ->sortable()
                    ->searchable(),

                \Filament\Tables\Columns\TextColumn::make('name')
                    ->label('Nom'),

                \Filament\Tables\Columns\TextColumn::make('last_name')
                    ->label('Prénom'),

                \Filament\Tables\Columns\TextColumn::make('unite.name')
                    ->label('Unité'),

                \Filament\Tables\Columns\TextColumn::make('sex')
                    ->badge()
                    ->color(fn($state) => $state === 'Homme' ? 'success' : 'info'),

                \Filament\Tables\Columns\TextColumn::make('tel'),

                \Filament\Tables\Columns\TextColumn::make('bank_account_id')
                    ->label('Compte'),

                \Filament\Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
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
            'index' => Pages\ListEmployees::route('/'),
            'create' => Pages\CreateEmployee::route('/create'),
            'edit' => Pages\EditEmployee::route('/{record}/edit'),
        ];
    }
}
