<?php

namespace App\Services;

use App\Models\Pedagog;
use App\Services\Pedagog\Dao\PedagogDao;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class PedagogService
{
    protected PedagogDao $pedagogDao;

    public function __construct(PedagogDao $pedagogDao)
    {
        $this->pedagogDao = $pedagogDao;
    }

    public function getAllPedagogues()
    {
        return $this->pedagogDao->getAll();
    }

    public function getPedagogueById(string $id): ?Pedagog
    {
        return $this->pedagogDao->findById($id);
    }

    public function createPedagogue(array $data): Pedagog
    {
        $this->validatePedagogueData($data, true);
        return $this->pedagogDao->create($data);
    }

    public function updatePedagogue(string $id, array $data): ?Pedagog
    {
        $pedagog = $this->pedagogDao->findById($id);
        if (!$pedagog) return null;

        $this->validatePedagogueData($data, false, $id);
        return $this->pedagogDao->update($pedagog, $data);
    }

    public function deletePedagogue(string $id): bool
    {
        $pedagog = $this->pedagogDao->findById($id);
        if (!$pedagog) return false;

        return $this->pedagogDao->delete($pedagog);
    }

    protected function validatePedagogueData(array $data, bool $isCreating = true, ?string $pedagogId = null): void
    {
        $rules = [
            'ped_id'    => $isCreating ? 'required|string|max:12|unique:pedagog,ped_id' : 'sometimes|string|max:12',
            'ped_em'    => ($isCreating ? 'required' : 'sometimes|required') . '|string|max:100',
            'ped_mb'    => ($isCreating ? 'required' : 'sometimes|required') . '|string|max:100',
            'ped_gjin'  => 'nullable|string|size:1|in:M,F',
            'ped_tit'   => 'nullable|string|max:50',
            'ped_dl'    => 'nullable|date',
            'ped_tel'   => 'nullable|string|max:20',
            'ped_email' => ($isCreating ? 'required' : 'sometimes|required') . '|email|max:150' . 
                (!$isCreating && $pedagogId ? '|unique:pedagog,ped_email,' . $pedagogId . ',ped_id' : '|unique:pedagog,ped_email'),
            'dep_id'    => 'required|exists:departament,dep_id',
            'user_id'   => 'nullable|exists:users,id'
        ];

        $validator = Validator::make($data, $rules);

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }
    }
}