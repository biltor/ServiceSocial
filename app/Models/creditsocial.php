<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class creditsocial extends Model
{
    protected $fillable = [
        'demande_credit_id',
        'employee_id',
        'type_credit_id',
        'amount_accord',
        'amount_dema',
        'amout_retenu',
        'date_amount',
        'type_payment',
        'state',
        'account_number',
    ];

    protected $casts = [
        'date_amount' => 'date',
        'amount_accord' => 'decimal:2',
        'amount_dema' => 'decimal:2',
    ];



    public function demandeCredit()
    {
        return $this->belongsTo(\App\Models\demande_credits::class, 'demande_credit_id');
    }

    public function employee()
    {
        return $this->belongsTo(\App\Models\employee::class, 'employee_id');
    }

    public function typeCredit()
    {
        return $this->belongsTo(\App\Models\typecredit::class, 'type_credit_id');
    }

    protected static function booted()
    {
        static::deleting(function ($credit) {

            $demande = $credit->demandeCredit;

            if ($demande) {
                $demande->etat = 'brouillon';
                $demande->save();
            }
        });
    }
}
