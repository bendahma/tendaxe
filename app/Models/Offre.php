<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use ChristianKuri\LaravelFavorite\Traits\Favoriteable;


class Offre extends Model
{
    use HasFactory, SoftDeletes, Favoriteable;

    protected $fillable = [
        'user_id',
        'titre',
        'img_offre',
        'img_offre2',
        'description',
        'date_pub',
        'date_limit',
        'statut',
        'type',
        'prix',
        'wilaya',
        'journalar_id',
        'journalfr_id',
        'adminetab_id',
        'etat',
    ];
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    public function adminetab()
    {
        return $this->belongsTo(Adminetab::class);
    }

    public function secteur()
    {
        return $this->belongsToMany(Secteur::class, 'offre_secteur');
    }

    public function journalar()
    {
        return $this->belongsTo(Journalar::class);
    }

    public function journalfr()
    {
        return $this->belongsTo(Journalfr::class);
    }
}
