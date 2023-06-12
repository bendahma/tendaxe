<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Abonnement extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'nom_abonnement',
        'date_debut',
        'date_fin',
        'session_limit',
        'etat',
    ];

    public function secteur()
    {
        return $this->belongsToMany(Secteur::class, 'abonnement_secteur');
    }
}
