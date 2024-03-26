<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use App\Models\User;
use App\Models\Wallet;


class Compte extends Model
{
    use HasFactory;

    protected $fillable =[
        'id',
        'solde',
        'user_id',
        'created_at',
        'updated_at',
    ];

    public function users():HasMany
    {
        return $this->hasMany(User::class);
    }

    public function wallet(): HasOne
    {
        return $this->hasOne(wallet::class);
    }
}
