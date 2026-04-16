<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pedagog extends Model
{
    protected $table = 'pedagog';
    
    protected $primaryKey = 'ped_id';
    
    public $incrementing = false;
    
    protected $keyType = 'string';

    protected $fillable = [
        'ped_id',
        'ped_em',
        'ped_mb',
        'ped_gjin',
        'ped_tit',
        'ped_dl',
        'ped_tel',
        'ped_email',
        'ped_dt',
        'dep_id',
        'user_id',
    ];
    
    protected $casts = [
        'ped_dl' => 'date',
        'ped_dt' => 'date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    
    public function departament()
    {
        return $this->belongsTo(Departament::class, 'dep_id', 'dep_id');
    }
    
    public function fakultetAsDean()
    {
        return $this->hasMany(Fakultet::class, 'ped_id', 'ped_id');
    }
    
    public function departamentsAsHead()
    {
        return $this->hasMany(Departament::class, 'ped_id', 'ped_id');
    }
}