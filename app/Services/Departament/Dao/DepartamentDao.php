<?php

namespace App\Services\Departament\Dao;

use App\Models\Departament;
use Illuminate\Database\Eloquent\Collection;

class DepartamentDao
{
    /**
     * Get all departaments.
     */
    public function getAll(): Collection
    {
        return Departament::with('fakultet')->get();
    }

    /**
     * Find departament by ID.
     */
    public function findById(string $id): ?Departament
    {
        return Departament::with('fakultet')->find($id);
    }

    /**
     * Create a new departament.
     */
    public function create(array $data): Departament
    {
        return Departament::create($data);
    }

    /**
     * Update an existing departament.
     */
    public function update(Departament $departament, array $data): Departament
    {
        $departament->update($data);
        return $departament->fresh(['fakultet']);
    }

    /**
     * Delete a departament.
     */
    public function delete(Departament $departament): bool
    {
        return $departament->delete();
    }

    /**
     * Check if departament exists by ID.
     */
    public function exists(string $id): bool
    {
        return Departament::where('dep_id', $id)->exists();
    }

    /**
     * Check if name is already taken (excluding specific departament).
     */
    public function isNameTaken(string $name, ?string $exceptId = null): bool
    {
        $query = Departament::where('dep_em', $name);
        
        if ($exceptId) {
            $query->where('dep_id', '!=', $exceptId);
        }
        
        return $query->exists();
    }
}