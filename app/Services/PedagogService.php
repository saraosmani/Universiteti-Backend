<?php

namespace App\Services;

use App\Models\Pedagog;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class PedagogService
{
    public function getAllPedagogues()
    {
        return Pedagog::all();
    }

    public function getPedagogueById($id)
    {
        return Pedagog::find($id);
    }

    public function createPedagogue(array $data)
    {
        $validator = Validator::make($data, [
            'emer' => 'required|string|max:255',
            'mbiemer' => 'required|string|max:255',
            'email' => 'required|email|unique:pedagoge,email',
            'departament_id' => 'required|exists:departamente,id',
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