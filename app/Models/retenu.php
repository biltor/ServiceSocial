<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class retenu extends Model
{

    protected $fillable = [
        'employee_id',
        'credit_id',
        'amount',
        'date_retenu',
    ];


        |--------------------------------------------------------------------------
    | Relations
    |--------------------------------------------------------------------------
    */

    public function employee(): BelongsTo
    {
        return $this->belongsTo(Employee::class);
    }

    public function credit(): BelongsTo
    {
        return $this->belongsTo(Credit::class);
    }


        /*
    |--------------------------------------------------------------------------
    | Attributs calculés
    |--------------------------------------------------------------------------
    */

    public function getMontantInitialAttribute(): float
    {
        return $this->credit?->amount_accord ?? 0;
    }

    public function getTypeCreditAttribute()
    {
        return $this->credit?->typeCredit;
    }

    public function getBalanceDueAttribute(): float
    {
        if (!$this->credit) {
            return 0;
        }

        $totalRetenues = self::where('credit_id', $this->credit_id)
            ->whereDate('date_retenu', '<=', $this->date_retenu)
            ->sum('amount');

        return max(
            0,
            $this->credit->amount_accord - $totalRetenues
        );
    }


}
