<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use NumberToWords\NumberToWords;

class contrats extends Model
{
    protected $fillable = [
        'reference',
        'credit_social_id',
        'employee_id',
        'amount',
        'amount_text',
        'amount_text_ar',
        'start_date',
        'end_date',
        'amount_retenu',
        'duration',
        'state',
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
    ];

    public function creditSocial()
    {
        return $this->belongsTo(creditsocial::class);
    }

    public function employee()
    {
        return $this->belongsTo(employee::class);
    }

    public function getAmountTextAttribute()
    {
        $numberToWords = new NumberToWords();
        $transformer = $numberToWords->getNumberTransformer('fr');

        return ucfirst($transformer->toWords((int) $this->amount)) . ' dinars algériens';
    }

    public function getAmountTextArAttribute()
    {
        $integer = floor($this->amount);
        $decimal = ($this->amount - $integer) * 100;

        $formatter = new \NumberFormatter("ar", \NumberFormatter::SPELLOUT);

        $text = $formatter->format($integer) . ' دينار';

        if ($decimal > 0) {
            $text .= ' و ' . $formatter->format($decimal) . ' سنتيم';
        }

        return $text . ' جزائري';
    }






    public function getDurationAttribute()
    {
        if (!$this->amount || !$this->amount_retenu || $this->amount_retenu == 0) {
            return 0;
        }

        return ceil($this->amount / $this->amount_retenu);
    }
}
