<?php

namespace App\Models;

use Carbon\Carbon;
use App\Models\UserSecteur;
use Illuminate\Support\Facades\Auth;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use ChristianKuri\LaravelFavorite\Traits\Favoriteability;


class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable, Favoriteability;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'adminetab_id',
        'nom',
        'prenom',
        'email',
        'password',
        'phone',
        'nom_entreprise',
        'wilaya',
        'commune',
        'secteurs',
        'type_user',
        'etat',
        'email_verified_at',
        'note'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function abonnement()
    {
        return $this->hasMany(Abonnement::class)->where('etat', 'active');
    }

    public function current_abonnement()
    {
        return $this->hasOne(Abonnement::class)
            // ->where('date_debut', '<=', Carbon::now())
            // ->where('date_fin', '>=', Carbon::now())
            ->whereRaw('(now() between date_debut and date_fin)')
            ->where('etat', 'active')
            ->latest();
    }

    public function pending_abonnement()
    {
        return $this->hasOne(Abonnement::class)
            ->where('etat', 'pending')
            ->latest();
    }

    public function offre()
    {
        return $this->hasMany(Offre::class);
    }

    public function etablissement()
    {
        return $this->belongsto(Adminetab::class);
    }

    public function adminetab()
    {
        return $this->belongsto(Adminetab::class);
    }

    public function notif()
    {
        return $this->hasOne(Notif::class)->latest();
    }
}
