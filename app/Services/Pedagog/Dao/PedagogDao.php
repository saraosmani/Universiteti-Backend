<?php

namespace App\Services\Pedagog\Dao;

use App\Models\Pedagog;
use Illuminate\Database\Eloquent\Collection;

class PedagogDao
{
    /**
     * Get all pedagogues with relationships.
     */
    public function getAll(): Collection
    {
        return Pedagog::with(['departament', 'user'])->get();
    }

    /**
     * Find pedagogue by ID.
     */
    public function findById(string $id): ?Pedagog
    {
        return Pedagog::with(['departament', 'user'])->find($id);
    }

    /**
     * Create a new pedagogue.
     */
    public function create(array $data): Pedagog
    {
        return Pedagog::create($data);
    }

    /**
     * Update an existing pedagogue.
     */
    public function update(Pedagog $pedagog, array $data): Pedagog
    {
        $pedagog->update($data);
        return $pedagog->fresh(['departament', 'user']);
    }

    /**
     * Delete a pedagogue.
     */
    public function delete(Pedagog $pedagog): bool
    {
        return $pedagog->delete();
    }

    /**
     * Check if pedagogue exists by ID.
     */
    public function exists(string $id): bool
    {
        return Pedagog::where('ped_id', $id)->exists();
    }

    /**
     * Check if email is already taken (excluding specific pedagogue).
     */
    public function isEmailTaken(string $email, ?string $exceptId = null): bool
    {
        $query = Pedagog::where('ped_email', $email);
        
        if ($exceptId) {
            $query->where('ped_id', '!=', $exceptId);
        }
        
        return $query->exists();
    }

    /**
     * Check if a specific user_id is already assigned to another pedagogue.
     */
    public function isUserAssigned(int $userId, ?string $exceptId = null): bool
    {
        $query = Pedagog::where('user_id', $userId);
        
        if ($exceptId) {
            $query->where('ped_id', '!=', $exceptId);
        }
        
        return $query->exists();
    }

    /**
     * Get pedagogues by department.
     */
    public function getByDepartment(string $depId): Collection
    {
        return Pedagog::where('dep_id', $depId)->with('user')->get();
    }
}