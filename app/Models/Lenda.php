<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lenda extends Model
{
    protected $table = 'lenda';
    
    protected $primaryKey = 'lend_id';
    
    public $incrementing = true;
    
    protected $keyType = 'int';
    
    public $timestamps = false;

    protected $fillable = [
        'lend_id',
        'lend_emer',
        'lend_kod',
        'dep_id',
    ];
    
    public function departament()
    {
        return $this->belongsTo(Departament::class, 'dep_id', 'dep_id');
    }
    
    public function seksione()
    {
        return $this->hasMany(Seksion::class, 'lend_id', 'lend_id');
    }
    
    public function regjistrime()
    {
        return $this->hasMany(Regjistrim::class, 'lend_id', 'lend_id');
    }
}