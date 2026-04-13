<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class mouvementBanque extends Model
{
    protected $fillable = [
        'reference',
        'type',
        'amount',
        'description',
        'date',
        'credit_social_id',
        'virement_id',
        'balance',
    ];
    protected $casts = [
        'date' => 'date',
        'amount' => 'decimal:2',
    ];





    protected static function booted()
    {
        static::creating(function ($mouvement) {

            //  dernier solde
            $lastBalance = self::latest()->value('balance') ?? 0;

            // calcul automatique
            if ($mouvement->type === 'credit') {
                $mouvement->balance = $lastBalance + $mouvement->amount;
            } else {
                $mouvement->balance = $lastBalance - $mouvement->amount;
            }
        });
    }
}
