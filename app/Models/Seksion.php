<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Seksion extends Model
{
    protected $table = 'seksion';
    protected $primaryKey = 'sek_id';
    public $timestamps = false;
    protected $fillable = [
        'sek_dita',
        'sek_ore_fillimi',
        'sek_ore_mbarimi',
        'sek_grupi',
        'sek_lloji',
        'lend_id',
        'ped_id',
        'salle_id',
        'sem_id',
        'prog_id',
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

    public function programStudimi()
    {
        return $this->belongsTo(ProgramStudimi::class, 'prog_id', 'prog_id');
    }

    public function regjistrime()
    {
        return $this->hasMany(Regjistrim::class, 'sek_id', 'sek_id');
    }
}
