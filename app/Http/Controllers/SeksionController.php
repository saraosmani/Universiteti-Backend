<?php

namespace App\Http\Controllers;

use App\Helpers\SeksionHelper;
use App\Models\Seksion;
use App\Models\Semestri;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SeksionController extends Controller
{
    public function seksionetAktive(): JsonResponse
    {
        $pedId = Auth::user()->pedagog->ped_id;

        $seksionet = Seksion::with([
            'lenda',
            'salle',
            'salle.godina',
            'programStudimi',
            'semestri',
            'semestri.vitAkademik',
        ])
        ->where('ped_id', $pedId)
        ->whereHas('semestri', fn($q) => $q->where('sem_aktiv', 1))
        ->orderByRaw("
            CASE sek_dita
                WHEN 'Hene'    THEN 1
                WHEN 'Marte'   THEN 2
                WHEN 'Merkure' THEN 3
                WHEN 'Enjte'   THEN 4
                WHEN 'Premte'  THEN 5
                WHEN 'Shtune'  THEN 6
                WHEN 'Diele'   THEN 7
            END, sek_ore_fillimi
        ")
        ->get();

        $semAktivId = Semestri::where('sem_aktiv', 1)->value('sem_id');

        $studentetPerSeksion = Seksion::withCount('regjistrime as nr_studenteve')
            ->where('ped_id', $pedId)
            ->where('sem_id', $semAktivId)
            ->get()
            ->keyBy('sek_id');

        $data = $seksionet->map(function ($s) use ($studentetPerSeksion) {
            return [
                'sek_id'         => $s->sek_id,
                'dita'           => $s->sek_dita,
                'ore_fillimi'    => $s->sek_ore_fillimi,
                'ore_mbarimi'    => $s->sek_ore_mbarimi,
                'orari'          => SeksionHelper::formatoOrarin($s->sek_ore_fillimi, $s->sek_ore_mbarimi),
                'lloji'          => $s->sek_lloji,
                'grupi'          => $s->sek_grupi,
                'lenda'          => [
                    'id'   => $s->lenda->lend_id,
                    'emer' => $s->lenda->lend_emer,
                    'kod'  => $s->lenda->lend_kod,
                ],
                'salla'          => [
                    'nr'    => $s->salle->salle_nr,
                    'godin' => $s->salle->godina->god_emer,
                ],
                'program_studim' => [
                    'id'   => $s->programStudimi->prog_id,
                    'emer' => $s->programStudimi->prog_em,
                    'nive' => $s->programStudimi->prog_niv,
                ],
                'semestri'       => [
                    'nr'  => $s->semestri->sem_nr,
                    'vit' => $s->semestri->vitAkademik->vit_emer,
                ],
                'nr_studenteve'  => $studentetPerSeksion->get($s->sek_id)?->nr_studenteve ?? 0,
            ];
        });

        return response()->json(['success' => true, 'data' => $data]);
    }

    public function historiku(Request $request): JsonResponse
    {
        $pedId = Auth::user()->pedagog->ped_id;

        $query = Seksion::with([
            'lenda',
            'programStudimi',
            'semestri',
            'semestri.vitAkademik',
        ])
        ->where('ped_id', $pedId);

        if ($request->filled('vit_id')) {
            $query->whereHas('semestri', fn($q) => $q->where('vit_id', $request->vit_id));
        }

        if ($request->filled('sem_nr')) {
            $query->whereHas('semestri', fn($q) => $q->where('sem_nr', $request->sem_nr));
        }

        $seksionet = $query
            ->join('semestri', 'seksion.sem_id', '=', 'semestri.sem_id')
            ->join('vit_akademik', 'semestri.vit_id', '=', 'vit_akademik.vit_id')
            ->orderByDesc('vit_akademik.vit_emer')
            ->orderBy('semestri.sem_nr')
            ->orderBy('seksion.sek_dita')
            ->select('seksion.*')
            ->get();

        $data = $seksionet->map(fn($s) => [
            'sek_id'   => $s->sek_id,
            'dita'     => $s->sek_dita,
            'orari'    => SeksionHelper::formatoOrarin($s->sek_ore_fillimi, $s->sek_ore_mbarimi),
            'lloji'    => $s->sek_lloji,
            'grupi'    => $s->sek_grupi,
            'lenda'    => [
                'emer' => $s->lenda->lend_emer,
                'kod'  => $s->lenda->lend_kod,
            ],
            'program'  => $s->programStudimi->prog_em,
            'semestri' => 'S' . $s->semestri->sem_nr . ' — ' . $s->semestri->vitAkademik->vit_emer,
        ]);

        return response()->json(['success' => true, 'data' => $data]);
    }
}