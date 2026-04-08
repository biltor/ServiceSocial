<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class virementbc extends Model
{
    protected $fillable = [
        'unite_id',
        'bank_account_id',
        'reference',
        'label',
        'amount',
        'attachment',
        'datevirement',
    ];

    public function unite()
    {
        return $this->belongsTo(unite::class);
    }

    public function bankAccount()
    {
        return $this->belongsTo(bank_account::class);
    }
}
