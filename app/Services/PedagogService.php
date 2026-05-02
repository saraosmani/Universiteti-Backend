<?php

namespace App\Services;

use App\Models\Pedagog;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class PedagogService
{
    public function getAllPedagogues()
    {
        return Pedagog::with("departament")->get();
    }

    public function getPedagogueById($id)
    {
        return Pedagog::find($id);
    }

    public function createPedagogue(array $data)
    {
        $validator = Validator::make($data, [
            "ped_id"    => "required|string|unique:pedagog,ped_id",
            "ped_em"    => "required|string|max:255",
            "ped_mb"    => "required|string|max:255",
            "ped_email" => "required|email|unique:pedagog,ped_email",
            "dep_id"    => "required|exists:departament,dep_id",
            "ped_gjin"  => "nullable|string|max:1",
            "ped_tit"   => "nullable|string|max:50",
            "ped_dl"    => "nullable|date",
            "ped_tel"   => "nullable|string|max:20",
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

        $user = User::find($pedagog->user_id);

        if ($user) {
            $userUpdate = [];
            if (isset($data["ped_em"]))    $userUpdate["name"]    = $data["ped_em"];
            if (isset($data["ped_mb"]))    $userUpdate["surname"] = $data["ped_mb"];
            if (isset($data["ped_email"])) $userUpdate["email"]   = $data["ped_email"];

            if (!empty($userUpdate)) {
                $user->update($userUpdate);
            }
        }

        return $pedagog;
    }

    public function deletePedagogue($id)
    {
        $pedagog = Pedagog::find($id);
        if (!$pedagog) return false;

        return $pedagog->delete();
    }
}
