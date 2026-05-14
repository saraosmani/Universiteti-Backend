<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Helpers\VleresimHelper;

class VleresimController extends Controller
{
    private function getPedId(): string
    {
        return Auth::user()->pedagog->ped_id;
    }


    public function getLendet()
    {
        $data = VleresimHelper::getLendet($this->getPedId());
        return response()->json($data);
    }

    public function getSemestre(Request $request)
    {
        $lendId = $request->query('lend_id');
        $data   = VleresimHelper::getSemestre($lendId, $this->getPedId());
        return response()->json($data);
    }

    public function getStudents(Request $request)
    {
        $lendId = $request->query('lend_id');
        $semId  = $request->query('sem_id');
        $data   = VleresimHelper::getStudents($lendId, $semId, $this->getPedId());
        return response()->json($data);
    }

    public function updateVleresim(Request $request, $regjId)
    {
        $validated = $request->validate([
            'pik_midterm' => ['nullable', 'integer', 'min:0', 'max:500'],
            'pik_final'   => ['nullable', 'integer', 'min:0', 'max:500'],
            'pik_detyra'  => ['nullable', 'integer', 'min:0', 'max:100'],
        ]);

        VleresimHelper::updateVleresim($regjId, $validated);
        return response()->json(['message' => 'Vlerësimi u ruajt me sukses!']);
    }
}