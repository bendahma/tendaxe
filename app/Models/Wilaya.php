<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wilaya extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'wilaya',
        'notif_id',
    ];
}
