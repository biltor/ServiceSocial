<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Models\employee ;
use App\Models\typecredit;

class demande_credits extends Model
{
    protected $table = 'demande_credits';

    protected $fillable = [
        'reference',
        'employee_id',
        'type_credit_id',
        'montant',
        'motif',
        'etat',
        'attachment',
        'note',
    ];

    // relation TYPE
    public function typeCredit()
    {
        return $this->belongsTo(typecredit::class, 'type_credit_id');
    }

    //  relation EMPLOYEE 
    public function employee()
    {
        return $this->belongsTo(employee::class, 'employee_id');
    }
    public function creditSocial()
    {
        return $this->hasOne(creditsocial::class);
    }

    // boot
    protected static function booted()
    {
        static::creating(function ($record) {

            $year = now()->year;

            $last = self::whereYear('created_at', $year)
                ->latest('id')
                ->first();

            $next = $last ? (int) substr($last->reference, 12, 4) + 1 : 1;

            $number = str_pad($next, 4, '0', STR_PAD_LEFT);

            $type = TypeCredit::find($record->type_credit_id)?->type ?? 'general';

            $record->reference = "social/{$year}/{$number}/{$type}";
            $record->date_demande = now();
            $record->etat = 'brouillon';
        });
    }
}