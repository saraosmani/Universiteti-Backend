<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Regjistrim extends Model
{
    protected $table = 'regjistrim';
    
    protected $primaryKey = 'regj_id';
    
    public $incrementing = true;
    
    protected $keyType = 'int';
    
    public $timestamps = false;

    protected $fillable = [
        'dat_regj',
        'pik_midterm',
        'pik_final',
        'pik_detyra',
        'regj_status',
        'sek_id',
        'lend_id',
        'stu_id',
    ];
    
    public function seksion()
    {
        return $this->belongsTo(Seksion::class, 'sek_id', 'sek_id');
    }
    
    public function lenda()
    {
        return $this->belongsTo(Lenda::class, 'lend_id', 'lend_id');
    }
    
    public function student()
    {
        return $this->belongsTo(Student::class, 'stu_id', 'stu_id');
    }
}