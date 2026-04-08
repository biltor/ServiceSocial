<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class typecredit extends Model
{
    protected $fillable = [
        'type',
        'title',
        'description',
        'max_amount',
    ];

    public function creditSocials()
{
    return $this->hasMany(\App\Models\creditsocial::class);
}

    public function demandes()
    {
        return $this->hasMany(demande_credits::class);
    }
}
