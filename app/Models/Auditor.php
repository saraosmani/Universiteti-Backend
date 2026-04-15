<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Auditor extends Model
{
    protected $table = 'auditor';
    
    protected $primaryKey = 'salle_id';
    
    public $incrementing = false;
    
    protected $keyType = 'int';
    
    public $timestamps = false;

    protected $fillable = [
        'salle_id',
        'aud_ka_aircon',
        'aud_ka_wifi',
        'aud_tip',
    ];
    
    public function salle()
    {
        return $this->belongsTo(Salle::class, 'salle_id', 'salle_id');
    }
}