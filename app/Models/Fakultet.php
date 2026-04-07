<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Fakultet extends Model
{
    protected $table = 'fakultet'; 

    protected $fillable = [
        'fak_em'
    ];
}