<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class employee extends Model
{
    protected $fillable = [
        'unite_id',
        'matricule',
        'name',
        'name_ar',
        'last_name',
        'last_name_ar',
        'sex',
        'datenais',
        'lieux',
        'nin',
        'tel',
        'post',
        'bank_name',
        'compte_bank',
    ];

    public function unite()
    {
        return $this->belongsTo(unite::class);
    }

    public function user()
    {
        return $this->hasOne(User::class);
    }

    public function getFullNameAttribute(): string
    {
        return "{$this->name} {$this->last_name}";
    }


    public function creditSocials()
    {
        return $this->hasMany(\App\Models\creditsocial::class);
    }
}
