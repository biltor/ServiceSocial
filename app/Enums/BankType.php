<?php

namespace App\Enums;

enum BankType: string
{
    case CCP = 'CCP';
    case BANK = 'Bank';

    public function label(): string
    {
        return match($this) {
            self::CCP => 'CCP',
            self::BANK => 'Banque',
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