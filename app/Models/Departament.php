<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Departament extends Model
{
    protected $table = 'departament';
    
    protected $primaryKey = 'dep_id';
    
    public $incrementing = false;
    
    protected $keyType = 'string';

    protected $fillable = [
        'dep_id',
        'dep_em',
        'fak_id',
        'ped_id'
    ];
    
    public function fakultet()
    {
        return $this->belongsTo(Fakultet::class, 'fak_id', 'fak_id');
    }
    
    public function pedagog()
    {
        return $this->belongsTo(Pedagog::class, 'ped_id', 'ped_id');
    }
    
    public function students()
    {
        return $this->hasMany(Student::class, 'dep_id', 'dep_id');
    }
    
    public function pedagogues()
    {
        return $this->hasMany(Pedagog::class, 'dep_id', 'dep_id');
    }
}