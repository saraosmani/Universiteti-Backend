<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $table = 'student';

    protected $fillable = [
        'stu_em',
        'stu_mb',
        'stu_atesi',
        'stu_gjini',
        'stu_dl',
        'stu_nuid',
        'stu_email',
        'stu_dat_regjistrim',
        'stu_status'
    ];
}