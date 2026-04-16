<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VitAkademik extends Model
{
    protected $table = 'vit_akademik';
    
    protected $primaryKey = 'vit_id';
    
    public $incrementing = false;
    
    protected $keyType = 'int';
    
    public $timestamps = false;

    protected $fillable = [
        'vit_id',
        'emer_id',
        'vit_emer',
        'vit_data_fillimit',
        'vit_data_mbarimi',
        'vit_aktiv',
    ];
    
    public function semestra()
    {
        return $this->hasMany(Semestri::class, 'vit_id', 'vit_id');
    }
}