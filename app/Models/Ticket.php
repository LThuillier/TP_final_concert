<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;

    // Champs que l'on a le droit de remplir
    protected $fillable = ['title', 'description', 'status', 'user_id'];

    // Relation : Un ticket appartient à un utilisateur
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
