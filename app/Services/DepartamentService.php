<?php

namespace App\Services;

use App\Models\Departament;
use App\Services\Departament\Dao\DepartamentDao;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class DepartamentService
{
    protected DepartamentDao $departamentDao;

    public function __construct(DepartamentDao $departamentDao)
    {
        $this->departamentDao = $departamentDao;
    }

    /**
     * Get all departaments.
     */
    public function getAllDepartaments()
    {
        return $this->departamentDao->getAll();
    }

    /**
     * Get a single departament by ID.
     */
    public function getDepartamentById(string $id): ?Departament
    {
        return $this->departamentDao->findById($id);
    }

    /**
     * Create a new departament.
     *
     * @throws ValidationException
     */
    public function createDepartament(array $data): Departament
    {
        $this->validateDepartamentData($data, true);
        
        return $this->departamentDao->create($data);
    }

    /**
     * Update an existing departament.
     *
     * @throws ValidationException
     */
    public function updateDepartament(string $id, array $data): ?Departament
    {
        $departament = $this->departamentDao->findById($id);
        
        if (!$departament) {
            return null;
        }

        $this->validateDepartamentData($data, false, $id);
        
        return $this->departamentDao->update($departament, $data);
    }

    /**
     * Delete a departament.
     */
    public function deleteDepartament(string $id): bool
    {
        $departament = $this->departamentDao->findById($id);
        
        if (!$departament) {
            return false;
        }

        return $this->departamentDao->delete($departament);
    }

    /**
     * Validate departament data.
     *
     * @throws ValidationException
     */
    protected function validateDepartamentData(array $data, bool $isCreating = true, ?string $depId = null): void
    {
        $rules = [
            'dep_id' => $isCreating 
                ? 'required|string|size:3|unique:departament,dep_id' 
                : 'sometimes|string|size:3',

            'dep_em' => ($isCreating ? 'required' : 'sometimes|required') . '|string|max:50|unique:departament,dep_em' . 
                (!$isCreating && $depId ? ',' . $depId . ',dep_id' : ''),

            'fak_id' => ($isCreating ? 'required' : 'sometimes|required') . '|exists:fakultet,fak_id',

            'ped_id' => ($isCreating ? 'required' : 'sometimes|required') . '|string|max:10'
        ];

        $validator = Validator::make($data, $rules);

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }
    }
}