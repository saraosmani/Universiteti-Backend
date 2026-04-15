<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Semestri extends Model
{
    protected $table = 'semestri';
    
    protected $primaryKey = 'sem_id';
    
    public $incrementing = false;
    
    protected $keyType = 'int';
    
    public $timestamps = false;

    protected $fillable = [
        'sem_id',
        'sem_nr',
        'sem_data_fillimit',
        'sem_data_mbarimi',
        'sem_aktiv',
        'vit_id',
    ];
    
    public function vitAkademik()
    {
        return $this->belongsTo(VitAkademik::class, 'vit_id', 'vit_id');
    }
    
    public function seksione()
    {
        return $this->hasMany(Seksion::class, 'sem_id', 'sem_id');
    }
}