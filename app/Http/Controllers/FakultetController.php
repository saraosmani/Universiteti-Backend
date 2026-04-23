<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Fakultet;

class FakultetController extends Controller
{
    public function getAllFakultete()
    {
        $fakultete = Fakultet::with(['pedagog', 'departaments'])->get();
        return response()->json($fakultete, 200);
    }

    public function getFakultetById($id)
    {
        $fakultet = Fakultet::with(['pedagog', 'departaments'])->find($id);
        
        if (!$fakultet) {
            return response()->json(['message' => 'Fakulteti nuk u gjet'], 404);
        }
        
        return response()->json($fakultet, 200);
    }

    public function addFakultet(Request $request)
    {
        $request->validate([
            'fak_id' => 'required|string|unique:fakultet,fak_id',
            'fak_em' => 'required|string',
            'ped_id' => 'nullable|string|exists:pedagog,ped_id',
        ]);

        $fakultet = Fakultet::create($request->all());
        return response()->json($fakultet, 201);
    }

    public function updateFakultet(Request $request, $id)
    {
        $fakultet = Fakultet::find($id);

        if (!$fakultet) {
            return response()->json(['message' => 'Fakulteti nuk u gjet'], 404);
        }

        $request->validate([
            'fak_em' => 'sometimes|string',
            'ped_id' => 'nullable|string|exists:pedagog,ped_id',
        ]);

        $fakultet->update($request->all());
        return response()->json($fakultet, 200);
    }

    public function deleteFakultet($id)
    {
        $fakultet = Fakultet::find($id);

        if (!$fakultet) {
            return response()->json(['message' => 'Fakulteti nuk u gjet'], 404);
        }

        $fakultet->delete();
        return response()->json(['message' => 'Fakulteti u fshi me sukses'], 200);
    }
}