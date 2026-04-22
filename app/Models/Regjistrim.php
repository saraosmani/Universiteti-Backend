<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Regjistrim extends Model
{
    protected $table = 'regjistrim';
    protected $primaryKey = 'regj_id';
    public $timestamps = false;

    protected $fillable = [
        'pik_midterm',
        'pik_final',
        'pik_detyra',
        'regj_status',
        'sek_id',
        'lend_id',
        'stu_id',
        'dat_regj',
    ];

    public function student()
    {
        return $this->belongsTo(Student::class, 'stu_id', 'stu_id');
    }

    public function seksion()
    {
        return $this->belongsTo(Seksion::class, 'sek_id', 'sek_id');
    }
}
