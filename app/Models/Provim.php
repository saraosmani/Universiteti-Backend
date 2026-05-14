<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Provim extends Model
{
    protected $table = 'provim';
    protected $primaryKey = 'prov_id';
    public $timestamps = false;

    protected $fillable = [
        'prov_data',
        'prov_ora',
        'prov_lloji',
        'lend_id',
        'ped_id',
        'salle_id',
        'sem_id',
    ];

    public function lenda()
    {
        return $this->belongsTo(Lenda::class, 'lend_id', 'lend_id');
    }

    public function pedagog()
    {
        return $this->belongsTo(Pedagog::class, 'ped_id', 'ped_id');
    }

    public function salle()
    {
        return $this->belongsTo(Salle::class, 'salle_id', 'salle_id');
    }

    public function semestri()
    {
        return $this->belongsTo(Semestri::class, 'sem_id', 'sem_id');
    }
}