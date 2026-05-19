<?php

namespace App\Enums;

enum AlgerianBank: string
{
    case BNA = 'BNA';
    case BADR = 'BADR';
    case BEA = 'BEA';
    case BDL = 'BDL';
    case CPA = 'CPA';
    case CNEP = 'CNEP';
    case AGB = 'AGB';
    case NATIXIS = 'NATIXIS';
    case SOCIETE_GENERALE = 'SOCIETE_GENERALE';
    case AL_BARAKA = 'AL_BARAKA';
    case TRUST_BANK = 'TRUST_BANK';
    case CCP = 'ALGÉRIE_POST';

    public function label(): string
    {
        return match($this) {
            self::BNA => 'Banque Nationale d’Algérie (BNA)',
            self::BADR => 'Banque de l’Agriculture et du Développement Rural (BADR)',
            self::BEA => 'Banque Extérieure d’Algérie (BEA)',
            self::BDL => 'Banque de Développement Local (BDL)',
            self::CPA => 'Crédit Populaire d’Algérie (CPA)',
            self::CNEP => 'CNEP Banque',
            self::AGB => 'Arab Gulf Bank (AGB)',
            self::NATIXIS => 'Natixis Algérie',
            self::SOCIETE_GENERALE => 'Société Générale Algérie',
            self::AL_BARAKA => 'Al Baraka Bank',
            self::TRUST_BANK => 'Trust Bank Algeria',
            self::CCP => 'Compte Courant Postal (CCP)',
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