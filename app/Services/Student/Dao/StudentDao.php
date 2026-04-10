<?php

namespace App\Services\Student\Dao;

use App\Models\Student;
use Illuminate\Database\Eloquent\Collection;

class StudentDao
{
    /**
     * Get all students with relationships.
     */
    public function getAll(): Collection
    {
        return Student::with('departament')->get();
    }

    /**
     * Find student by ID.
     */
    public function findById(string $id): ?Student
    {
        return Student::with('departament')->find($id);
    }

    /**
     * Create a new student.
     */
    public function create(array $data): Student
    {
        return Student::create($data);
    }

    /**
     * Update an existing student.
     */
    public function update(Student $student, array $data): Student
    {
        $student->update($data);
        return $student->fresh(['departament']);
    }

    /**
     * Delete a student.
     */
    public function delete(Student $student): bool
    {
        return $student->delete();
    }

    /**
     * Check if student exists by ID.
     */
    public function exists(string $id): bool
    {
        return Student::where('stu_id', $id)->exists();
    }

    /**
     * Check if email is already taken (excluding specific student).
     */
    public function isEmailTaken(string $email, ?string $exceptId = null): bool
    {
        $query = Student::where('stu_email', $email);
        
        if ($exceptId) {
            $query->where('stu_id', '!=', $exceptId);
        }
        
        return $query->exists();
    }

    /**
     * Check if NUID is already taken (excluding specific student).
     */
    public function isNuidTaken(string $nuid, ?string $exceptId = null): bool
    {
        $query = Student::where('stu_nuid', $nuid);
        
        if ($exceptId) {
            $query->where('stu_id', '!=', $exceptId);
        }
        
        return $query->exists();
    }
}
