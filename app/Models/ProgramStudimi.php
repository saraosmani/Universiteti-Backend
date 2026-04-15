<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProgramStudimi extends Model
{
    protected $table = 'program_studimi';
    
    protected $primaryKey = 'prog_id';
    
    public $incrementing = false;
    
    protected $keyType = 'string';
    
    public $timestamps = false;

    protected $fillable = [
        'prog_id',
        'prog_em',
        'prog_niv',
        'prog_krd',
        'dep_id',
    ];
    
    public function departament()
    {
        return $this->belongsTo(Departament::class, 'dep_id', 'dep_id');
    }
    
    public function seksione()
    {
        return $this->hasMany(Seksion::class, 'prog_id', 'prog_id');
    }
    
    public function studentet()
    {
        return $this->hasMany(Student::class, 'prog_id', 'prog_id');
    }
}