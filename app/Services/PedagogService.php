<?php

namespace App\Services;

use App\Models\Pedagog;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class PedagogService
{

    public function getAllPedagogues()
    {
        // Përdorim 'with' që të marrim edhe të dhënat e departamentit automatikisht
        return Pedagog::with('departament')->get();
    }


    public function getPedagogueById($id)
    {
        return Pedagog::find($id);
    }


    public function createPedagogue(array $data)
    {
        $validator = Validator::make($data, [
            'ped_id'         => 'required|string|unique:pedagog,ped_id',
            'ped_em'         => 'required|string|max:255',
            'ped_mb'         => 'required|string|max:255',
            'ped_email'      => 'required|email|unique:pedagog,ped_email',
            'dep_id'         => 'required|exists:departament,dep_id',
            'ped_gjin'       => 'nullable|string|max:1',
            'ped_tit'        => 'nullable|string|max:50',
            'ped_dl'         => 'nullable|date',
            'ped_tel'        => 'nullable|string|max:20',
        ]);

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }

        return Pedagog::create($data);
    }


    public function updatePedagogue($id, array $data)
    {
        $pedagog = Pedagog::find($id);
        if (!$pedagog) return null;

        $pedagog->update($data);
        return $pedagog;
    }


    public function deletePedagogue($id)
    {
        $pedagog = Pedagog::find($id);
        if (!$pedagog) return false;

        return $pedagog->delete();
    }
}