<?php

namespace App\Enums;

enum wilyas: string
{
    case ADRAR = '01';
    case CHLEF = '02';
    case LAGHOUAT = '03';
    case OUM_EL_BOUAGHI = '04';
    case BATNA = '05';
    case BEJAIA = '06';
    case BISKRA = '07';
    case BECHAR = '08';
    case BLIDA = '09';
    case BOUIRA = '10';
    case TAMANRASSET = '11';
    case TEBESSA = '12';
    case TLEMCEN = '13';
    case TIARET = '14';
    case TIZI_OUZOU = '15';
    case ALGER = '16';
    case DJELFA = '17';
    case JIJEL = '18';
    case SETIF = '19';
    case SAIDA = '20';
    case SKIKDA = '21';
    case SIDI_BEL_ABBES = '22';
    case ANNABA = '23';
    case GUELMA = '24';
    case CONSTANTINE = '25';
    case MEDEA = '26';
    case MOSTAGANEM = '27';
    case MSILA = '28';
    case MASCARA = '29';
    case OUARGLA = '30';
    case ORAN = '31';
    case EL_BAYADH = '32';
    case ILLIZI = '33';
    case BORDJ_BOU_ARRERIDJ = '34';
    case BOUMERDES = '35';
    case EL_TARF = '36';
    case TINDOUF = '37';
    case TISSEMSILT = '38';
    case EL_OUED = '39';
    case KHENCHELA = '40';
    case SOUK_AHRAS = '41';
    case TIPAZA = '42';
    case MILA = '43';
    case AIN_DEFLA = '44';
    case NAAMA = '45';
    case AIN_TEMOUCHENT = '46';
    case GHARDAIA = '47';
    case RELIZANE = '48';
    case TIMIMOUN = '49';
    case BORDJ_BADJI_MOKHTAR = '50';
    case OULED_DJELLAL = '51';
    case BENI_ABBES = '52';
    case IN_SALAH = '53';
    case IN_GUEZZAM = '54';
    case TOUGGOURT = '55';
    case DJANET = '56';
    case EL_MGHAIER = '57';
    case EL_MENIAA = '58';


 public function label(): string
    {
        return match($this) {
            self::ADRAR => 'Adrar',
            self::CHLEF => 'Chlef',
            self::LAGHOUAT => 'Laghouat',
            self::OUM_EL_BOUAGHI => 'Oum El Bouaghi',
            self::BATNA => 'Batna',
            self::BEJAIA => 'Béjaïa',
            self::BISKRA => 'Biskra',
            self::BECHAR => 'Béchar',
            self::BLIDA => 'Blida',
            self::BOUIRA => 'Bouira',
            self::TAMANRASSET => 'Tamanrasset',
            self::TEBESSA => 'Tébessa',
            self::TLEMCEN => 'Tlemcen',
            self::TIARET => 'Tiaret',
            self::TIZI_OUZOU => 'Tizi Ouzou',
            self::ALGER => 'Alger',
            self::DJELFA => 'Djelfa',
            self::JIJEL => 'Jijel',
            self::SETIF => 'Sétif',
            self::SAIDA => 'Saïda',
            self::SKIKDA => 'Skikda',
            self::SIDI_BEL_ABBES => 'Sidi Bel Abbès',
            self::ANNABA => 'Annaba',
            self::GUELMA => 'Guelma',
            self::CONSTANTINE => 'Constantine',
            self::MEDEA => 'Médéa',
            self::MOSTAGANEM => 'Mostaganem',
            self::MSILA => 'M’sila',
            self::MASCARA => 'Mascara',
            self::OUARGLA => 'Ouargla',
            self::ORAN => 'Oran',
            self::EL_BAYADH => 'El Bayadh',
            self::ILLIZI => 'Illizi',
            self::BORDJ_BOU_ARRERIDJ => 'Bordj Bou Arréridj',
            self::BOUMERDES => 'Boumerdès',
            self::EL_TARF => 'El Tarf',
            self::TINDOUF => 'Tindouf',
            self::TISSEMSILT => 'Tissemsilt',
            self::EL_OUED => 'El Oued',
            self::KHENCHELA => 'Khenchela',
            self::SOUK_AHRAS => 'Souk Ahras',
            self::TIPAZA => 'Tipaza',
            self::MILA => 'Mila',
            self::AIN_DEFLA => 'Aïn Defla',
            self::NAAMA => 'Naâma',
            self::AIN_TEMOUCHENT => 'Aïn Témouchent',
            self::GHARDAIA => 'Ghardaïa',
            self::RELIZANE => 'Relizane',
            self::TIMIMOUN => 'Timimoun',
            self::BORDJ_BADJI_MOKHTAR => 'Bordj Badji Mokhtar',
            self::OULED_DJELLAL => 'Ouled Djellal',
            self::BENI_ABBES => 'Béni Abbès',
            self::IN_SALAH => 'In Salah',
            self::IN_GUEZZAM => 'In Guezzam',
            self::TOUGGOURT => 'Touggourt',
            self::DJANET => 'Djanet',
            self::EL_MGHAIER => 'El M’Ghair',
            self::EL_MENIAA => 'El Meniaa',
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
