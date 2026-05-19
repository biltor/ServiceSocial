<?php

namespace App\Enums;

enum FamilyRelationType: string
{
    case PERE = 'pere';
    case MERE = 'mere';
    case FRERE = 'frere';
    case SOEUR = 'soeur';
    case FILS = 'fils';
    case FILLE = 'fille';
    case EPOUX = 'epoux';
    case EPOUSE = 'epouse';
    case ONCLE = 'oncle';
    case TANTE = 'tante';
    case COUSIN = 'cousin';
    case COUSINE = 'cousine';
    case GRAND_PERE = 'grand_pere';
    case GRAND_MERE = 'grand_mere';

    public function label(): string
    {
        return match($this) {
            self::PERE => 'Père',
            self::MERE => 'Mère',
            self::FRERE => 'Frère',
            self::SOEUR => 'Sœur',
            self::FILS => 'Fils',
            self::FILLE => 'Fille',
            self::EPOUX => 'Époux',
            self::EPOUSE => 'Épouse',
            self::ONCLE => 'Oncle',
            self::TANTE => 'Tante',
            self::COUSIN => 'Cousin',
            self::COUSINE => 'Cousine',
            self::GRAND_PERE => 'Grand-père',
            self::GRAND_MERE => 'Grand-mère',
        };
    }

    public static function options(): array
    {
        return collect(self::cases())
            ->mapWithKeys(fn ($case) => [
                $case->value => $case->label()
            ])
            ->toArray();
    }
}
