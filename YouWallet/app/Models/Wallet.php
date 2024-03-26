<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

use App\Models\Compte;

class Wallet extends Model
{
    use HasFactory;

    protected $fillable =[
        'id',
        'montant',
        'motif',
        'sender_id',
        'receiver_id',
        'created_at',
        'updated_at',
    ];

    public function Compte():BelongsTo
    {
        return $this->belongsTo(Compte::class);
    }
};
