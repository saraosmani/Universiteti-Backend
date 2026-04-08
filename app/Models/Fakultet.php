<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Fakultet extends Model
{
    protected $table = 'fakultet';
    
    protected $primaryKey = 'fak_id';
    
    public $incrementing = false;
    
    protected $keyType = 'string';

    protected $fillable = [
        'fak_id',
        'fak_em',
        'ped_id'
    ];
    
    public function pedagog()
    {
        return $this->belongsTo(Pedagog::class, 'ped_id', 'ped_id');
    }
    
    public function departaments()
    {
        return $this->hasMany(Departament::class, 'fak_id', 'fak_id');
    }
}