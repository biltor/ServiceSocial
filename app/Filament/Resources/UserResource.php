<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Filament\Resources\UserResource\RelationManagers;
use App\Models\employee;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Spatie\Permission\Models\Role;
<<<<<<< HEAD
use Illuminate\Support\Facades\Auth;

=======
>>>>>>> 0ffb82d (working on)

class UserResource extends Resource
{
    protected static ?string $model          = User::class;
    protected static ?string $navigationIcon = 'heroicon-o-user-circle';
    protected static ?string $navigationGroup = 'Administration';
    protected static ?string $label          = 'Utilisateur';
    protected static ?string $pluralLabel    = 'Utilisateurs';


    // Accessible uniquement au super_admin
<<<<<<< HEAD
    protected static function isSuperAdmin(): bool
    {
        /** @var User|null $user */
        $user = Auth::user();

        return $user?->hasRole('super_admin') ?? false;
    }

    public static function canViewAny(): bool
    {
        return static::isSuperAdmin();
    }

    public static function canCreate(): bool
    {
        return static::isSuperAdmin();
    }

    public static function canEdit($record): bool
    {
        return static::isSuperAdmin();
    }

    public static function canDelete($record): bool
    {
        return static::isSuperAdmin();
    }

    public static function shouldRegisterNavigation(): bool
    {
        return static::isSuperAdmin();
    }

=======
>>>>>>> 0ffb82d (working on)


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
                Forms\Components\Section::make('Informations du compte')
                    ->icon('heroicon-o-user')
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->label('Nom complet')
                            ->required(),

                        Forms\Components\TextInput::make('email')
                            ->label('Email')
                            ->email()
                            ->required()
                            ->unique(ignoreRecord: true),

                        Forms\Components\TextInput::make('password')
                            ->label('Mot de passe')
                            ->password()
                            ->dehydrateStateUsing(fn($state) => bcrypt($state))
                            ->dehydrated(fn($state) => filled($state))
                            ->required(fn(string $operation) => $operation === 'create')
                            ->placeholder('Laisser vide pour ne pas modifier'),
<<<<<<< HEAD

                        Forms\Components\Select::make('unites')
                            ->multiple()
                            ->relationship('unites', 'name')
                            ->preload()
                            ->searchable(),
=======
>>>>>>> 0ffb82d (working on)
                    ])->columns(2),

                Forms\Components\Section::make('Rôle & Employé')
                    ->icon('heroicon-o-shield-check')
                    ->schema([

                        // ── Sélection du rôle ──────────────────
                        Forms\Components\Select::make('roles')
                            ->label('Rôle')
                            ->options(
                                Role::all()->pluck('name', 'name')
                            )
                            ->searchable()
                            ->required()
                            ->native(false)
                            ->placeholder('Choisir un rôle...')
                            ->afterStateHydrated(function ($component, $record) {
                                if ($record) {
                                    $component->state(
                                        $record->roles->pluck('name')->first()
                                    );
                                }
                            }),

                        // ── Lier à un employé ──────────────────
                        Forms\Components\Select::make('employee_id')
                            ->label('Employée')
                            ->relationship('employee', 'name')
                            ->getOptionLabelFromRecordUsing(function ($record) {
                                return $record->matricule . ' - ' . $record->name . ' ' . $record->last_name;
                            })
                            ->searchable()
                            ->required(),

                    ])->columns(2),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([

                Tables\Columns\TextColumn::make('name')
                    ->label('Nom')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('email')
                    ->label('Email')
                    ->searchable()
                    ->sortable()
                    ->copyable(),

                Tables\Columns\TextColumn::make('roles.name')
                    ->label('Rôles')
                    ->badge()
                    ->separator(',')
                    ->color(fn(string $state): string => match ($state) {
                        'RH' => 'success',
                        'service_social' => 'info',
                        'comptable' => 'warning',
                        'super_admin' => 'danger',
                        default => 'gray',
                    }),

                Tables\Columns\TextColumn::make('employee.matricule')
                    ->label('Matricule')
                    ->searchable()
                    ->sortable()
                    ->default('—'),

                Tables\Columns\TextColumn::make('employee.name')
                    ->label('Employé')
                    ->formatStateUsing(
                        fn($record) =>
                        $record->employee
                            ? $record->employee->name . ' ' . $record->employee->last_name
                            : '—'
                    )
                    ->searchable(),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Créé le')
                    ->dateTime('d/m/Y')
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('roles')
                    ->relationship('roles', 'name')
                    ->label('Filtrer par rôle'),

                Tables\Filters\TernaryFilter::make('employee_id')
                    ->label('Employé lié')
                    ->nullable(),
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
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}
