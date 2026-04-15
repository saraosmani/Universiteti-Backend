<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Salle extends Model
{
    protected $table = 'salle';
    
    protected $primaryKey = 'salle_id';
    
    public $incrementing = false;
    
    protected $keyType = 'int';
    
    public $timestamps = false;

    protected $fillable = [
        'salle_id',
        'salle_nr',
        'salle_kati',
        'salle_kapacitet',
        'salle_tip',
        'god_id',
    ];
    
    public function godina()
    {
        return $this->belongsTo(Godina::class, 'god_id', 'god_id');
    }
    
    public function auditor()
    {
        return $this->hasOne(Auditor::class, 'salle_id', 'salle_id');
    }
    
    public function seksione()
    {
        return $this->hasMany(Seksion::class, 'salle_id', 'salle_id');
    }
}