<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use  Illuminate\Support\Facades\Auth;
use App\Helpers\VleresimHelper;

class VleresimController extends Controller
{
    public function getLendet()
    {
        $pedId = auth::user()->pedagog->ped_id;
        $data = VleresimHelper::getLendet($pedId);
        return response()->json($data);
    }

    public function getSemestre(Request $request)
    {
        $pedId = auth::user()->pedagog->ped_id;
        $lendId = $request->query('lend_id');
        $data   = VleresimHelper::getSemestre($lendId, $pedId);
        return response()->json($data);
    }

    public function getStudents(Request $request)
    {
        $pedId = auth::user()->pedagog->ped_id;
        $lendId = $request->query('lend_id');
        $semId  = $request->query('sem_id');
        $data   = VleresimHelper::getStudents($lendId, $semId, $pedId);
        return response()->json($data);
    }

    public function updateVleresim(Request $request, $regjId)
    {
        $data = $request->only(['pik_midterm', 'pik_final', 'pik_detyra']);
        VleresimHelper::updateVleresim($regjId, $data);
        return response()->json(['message' => 'Vlerësimi u ruajt me sukses']);
    }
}
