<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class dons extends Model
{
    use HasFactory;

    protected $table = 'dons';

    protected $fillable = [
        'employee_id',
        'contact_id',
        'type_credit_id',
        'montant',
        'date_don',
        'type_payment',
        'refpayement',
        'attachment',
        'note',
    ];
      protected $casts = [
        'date_don' => 'date',
        'montant' => 'decimal:2',
    ];



}