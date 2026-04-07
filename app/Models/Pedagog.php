<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pedagog extends Model
{
    protected $table = 'pedagog';

    protected $fillable = [
        'ped_em',
        'ped_mb',
        'ped_email',
        'ped_tel'
    ];
}