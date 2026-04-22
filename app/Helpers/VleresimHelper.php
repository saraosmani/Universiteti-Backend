<?php

namespace App\Helpers;

use App\Models\Lenda;
use App\Models\Seksion;
use App\Models\Regjistrim;
use Illuminate\Support\Facades\DB;

class VleresimHelper
{
    public static function getLendet($pedId)
    {
        return Lenda::whereHas('seksione', function ($query) use ($pedId) {
                $query->where('ped_id', $pedId);
            })
            ->select('lend_id', 'lend_emer', 'lend_kod')
            ->orderBy('lend_emer')
            ->get();
    }

    public static function getSemestre($lendId, $pedId)
    {
        return DB::table('seksion')
            ->join('semestri', 'seksion.sem_id', '=', 'semestri.sem_id')
            ->join('vit_akademik', 'semestri.vit_id', '=', 'vit_akademik.vit_id')
            ->where('seksion.lend_id', $lendId)
            ->where('seksion.ped_id', $pedId)
            ->select(
                'semestri.sem_id',
                'semestri.sem_nr',
                'vit_akademik.vit_id',
                'vit_akademik.vit_emer'
            )
            ->distinct()
            ->orderByDesc('vit_akademik.vit_emer')
            ->orderBy('semestri.sem_nr')
            ->get();
    }

    public static function getStudents($lendId, $semId, $pedId)
    {
        return DB::table('regjistrim')
            ->join('student', 'regjistrim.stu_id', '=', 'student.stu_id')
            ->join('seksion', 'regjistrim.sek_id', '=', 'seksion.sek_id')
            ->where('seksion.ped_id', $pedId)
            ->where('seksion.lend_id', $lendId)
            ->where('seksion.sem_id', $semId)
            ->select(
                'regjistrim.regj_id',
                'student.stu_id',
                'student.stu_em',
                'student.stu_mb',
                'seksion.sek_id',
                'seksion.sek_grupi',
                'seksion.sek_lloji',
                'regjistrim.pik_midterm',
                'regjistrim.pik_final',
                'regjistrim.pik_detyra',
                'regjistrim.regj_status'
            )
            ->orderBy('seksion.sek_grupi')
            ->orderBy('student.stu_mb')
            ->orderBy('student.stu_em')
            ->get();
    }

    public static function updateVleresim($regjId, $data)
    {
        $midterm = $data['pik_midterm'] ?? null;
        $final   = $data['pik_final'] ?? 0;
        $detyra  = $data['pik_detyra'] ?? 0;

        if (is_null($midterm)) {
            $status = 'Mungon';
        } elseif (($midterm + $final + $detyra) >= 500) {
            $status = 'Kalon';
        } else {
            $status = 'Nuk kalon';
        }

        return Regjistrim::where('regj_id', $regjId)->update([
            'pik_midterm' => $midterm,
            'pik_final'   => $final,
            'pik_detyra'  => $detyra,
            'regj_status' => $status,
        ]);
    }
}