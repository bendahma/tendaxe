<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Journalfr extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom',
        'logo',
    ];
}
