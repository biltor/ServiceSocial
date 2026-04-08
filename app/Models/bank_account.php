<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class bank_account extends Model
{
    protected $fillable = [
        'bank_name',
        'n_compte',
        'unite_id',
    ];

    protected static function booted()
    {
        static::saving(function ($record) {

            if ($record->is_active) {

                self::where('unite_id', $record->unite_id)
                    ->where('id', '!=', $record->id)
                    ->update(['is_active' => false]);
            }
        });
    }

    public function unite()
    {
        return $this->belongsTo(Unite::class);
    }
}
