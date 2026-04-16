<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Godina extends Model
{
    protected $table = 'godina';
    
    protected $primaryKey = 'god_id';
    
    public $incrementing = true;
    
    protected $keyType = 'int';
    
    public $timestamps = false;

    protected $fillable = [
        'god_id',
        'god_emer',
        'god_adresa',
    ];
    
    public function salle()
    {
        return $this->hasMany(Salle::class, 'god_id', 'god_id');
    }
}