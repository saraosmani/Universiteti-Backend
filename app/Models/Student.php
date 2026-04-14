<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $table = 'student';
    
    protected $primaryKey = 'stu_id';
    
    public $incrementing = false;
    
    protected $keyType = 'string';

    protected $fillable = [
        'stu_id',
        'stu_em',
        'stu_mb',
        'stu_atesi',
        'stu_gjini',
        'stu_dl',
        'stu_nuid',
        'stu_email',
        'stu_dat_regjistrim',
        'stu_status',
        'dep_id',
        'user_id',
    ];
    
    protected $casts = [
        'stu_dl' => 'date',
        'stu_dat_regjistrim' => 'date',
    ];
    
    public function departament()
    {
        return $this->belongsTo(Departament::class, 'dep_id', 'dep_id');
    }
}