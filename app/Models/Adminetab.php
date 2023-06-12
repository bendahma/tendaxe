<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Adminetab extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom_etablissement',
        'category',
        'wilaya',
        'commune',
        'fax',
        'fix',
        'email',
        'logo',
    ];
}
