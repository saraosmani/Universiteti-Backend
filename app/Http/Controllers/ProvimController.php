<?php

namespace App\Http\Controllers;

use App\Models\Provim;
use App\Models\Semestri;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProvimController extends Controller
{
    /**
     * GET /api/provime
     * Kthen të gjitha provimet e pedagogut të autentifikuar (të gjitha semestrat).
     */
    public function list(): JsonResponse
    {
        $pedId = Auth::user()->pedagog->ped_id;

        $provime = Provim::with([
            'lenda',
            'salle',
            'salle.godina',
            'semestri',
            'semestri.vitAkademik',
        ])
            ->where('ped_id', $pedId)
            ->orderBy('prov_data')
            ->orderBy('prov_ora')
            ->get();

        $data = $provime->map(fn($p) => [
            'prov_id'  => $p->prov_id,
            'data'     => $p->prov_data,
            'ora'      => $p->prov_ora,
            'lloji'    => $p->prov_lloji,
            'lenda'    => [
                'id'   => $p->lenda->lend_id,
                'emer' => $p->lenda->lend_emer,
                'kod'  => $p->lenda->lend_kod,
            ],
            'salla'    => [
                'nr'    => $p->salle->salle_nr,
                'godin' => $p->salle->godina->god_emer ?? '',
            ],
            'semestri' => [
                'nr'  => $p->semestri->sem_nr,
                'vit' => $p->semestri->vitAkademik->vit_emer ?? '',
            ],
        ]);

        return response()->json(['success' => true, 'data' => $data]);
    }

    /**
     * POST /api/provime
     * Krijon një provim të ri.
     */
    public function add(Request $request): JsonResponse
    {
        $pedId = Auth::user()->pedagog->ped_id;

        $validated = $request->validate([
            'prov_data'  => 'required|date',
            'prov_ora'   => 'required|date_format:H:i',
            'prov_lloji' => 'required|in:Final,Midterm,Rikuperim',
            'lend_id'    => 'required|integer|exists:lenda,lend_id',
            'salle_id'   => 'required|integer|exists:auditor,salle_id',
            'sem_id'     => 'required|integer|exists:semestri,sem_id',
        ]);

        $provim = Provim::create(array_merge($validated, ['ped_id' => $pedId]));

        return response()->json([
            'success' => true,
            'prov_id' => $provim->prov_id
        ], 201);
    }

    /**
     * PUT /api/provime/{id}
     * Përditëson një provim ekzistues
     * vetëm nëse i përket pedagogut aktual.
     */
    public function update(Request $request, int $id): JsonResponse
    {
        $pedId = Auth::user()->pedagog->ped_id;

        $provim = Provim::where('prov_id', $id)
            ->where('ped_id', $pedId)
            ->firstOrFail();

        $validated = $request->validate([
            'prov_data'  => 'sometimes|date',
            'prov_ora'   => 'sometimes|date_format:H:i',
            'prov_lloji' => 'sometimes|in:Final,Midterm,Rikuperim',
            'lend_id'    => 'sometimes|integer|exists:lenda,lend_id',
            'salle_id'   => 'sometimes|integer|exists:auditor,salle_id',
            'sem_id'     => 'sometimes|integer|exists:semestri,sem_id',
        ]);

        $provim->update($validated);

        return response()->json(['success' => true]);
    }

    /**
     * DELETE /api/provime/{id}
     * Fshin një provim ekzistues
     * vetëm nëse i përket pedagogut aktual.
     */
    public function delete(int $id): JsonResponse
    {
        $pedId = Auth::user()->pedagog->ped_id;

        $provim = Provim::where('prov_id', $id)
            ->where('ped_id', $pedId)
            ->firstOrFail();

        $provim->delete();

        return response()->json(['success' => true]);
    }
}