<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class unite extends Model
{
    protected $fillable = [
        'name',
        'email',
        'wilaya',
        'bank_account_id',
    ];
    public function bankAccounts()
    {
        return $this->hasMany(bank_account::class);
    }

    public function activeBankAccount()
    {
        return $this->hasOne(bank_account::class)->where('is_active', true);
    }

public function users()
{
    return $this->belongsToMany(
        User::class,
        'company_user',
        'unite_id',
        'user_id'
    );
}

    public function employees()
    {
        return $this->hasMany(Employee::class);
    }
}
