<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    // Champs que l'on a le droit de remplir
    protected $fillable = ['amount', 'status', 'user_id'];

    // Relation : Un paiement appartient à un utilisateur
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}