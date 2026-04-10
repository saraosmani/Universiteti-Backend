<?php

namespace App\Services;

use App\Models\Student;
use App\Services\Student\Dao\StudentDao;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class StudentService
{
    protected StudentDao $studentDao;

    public function __construct(StudentDao $studentDao)
    {
        $this->studentDao = $studentDao;
    }

    /**
     * Get all students.
     */
    public function getAllStudents()
    {
        return $this->studentDao->getAll();
    }

    /**
     * Get a single student by ID.
     */
    public function getStudentById(string $id): ?Student
    {
        return $this->studentDao->findById($id);
    }

    /**
     * Create a new student.
     *
     * @throws ValidationException
     */
    public function createStudent(array $data): Student
    {
        $this->validateStudentData($data, true);
        
        return $this->studentDao->create($data);
    }

    /**
     * Update an existing student.
     *
     * @throws ValidationException
     */
    public function updateStudent(string $id, array $data): ?Student
    {
        $student = $this->studentDao->findById($id);
        
        if (!$student) {
            return null;
        }

        $this->validateStudentData($data, false, $id);
        
        return $this->studentDao->update($student, $data);
    }

    /**
     * Delete a student.
     */
    public function deleteStudent(string $id): bool
    {
        $student = $this->studentDao->findById($id);
        
        if (!$student) {
            return false;
        }

        return $this->studentDao->delete($student);
    }

    /**
     * Validate student data.
     *
     * @throws ValidationException
     */
    protected function validateStudentData(array $data, bool $isCreating = true, ?string $studentId = null): void
    {
        $rules = [
            'stu_id' => $isCreating ? 'required|string|max:12|unique:student,stu_id' : 'sometimes|string|max:12',
            'stu_em' => ($isCreating ? 'required' : 'sometimes|required') . '|string|max:100',
            'stu_mb' => ($isCreating ? 'required' : 'sometimes|required') . '|string|max:100',
            'stu_atesi' => 'nullable|string|max:100',
            'stu_gjini' => ($isCreating ? 'required' : 'sometimes|required') . '|string|size:1|in:M,F',
            'stu_dl' => ($isCreating ? 'required' : 'sometimes|required') . '|date',
            'stu_nuid' => ($isCreating ? 'required' : 'sometimes|required') . '|string|size:10' . 
                (!$isCreating && $studentId ? '|unique:student,stu_nuid,' . $studentId . ',stu_id' : '|unique:student,stu_nuid'),
            'stu_email' => ($isCreating ? 'required' : 'sometimes|required') . '|email|max:150' . 
                (!$isCreating && $studentId ? '|unique:student,stu_email,' . $studentId . ',stu_id' : '|unique:student,stu_email'),
            'stu_dat_regjistrim' => ($isCreating ? 'required' : 'sometimes|required') . '|date',
            'stu_status' => 'nullable|string',
            'dep_id' => 'nullable|exists:departament,dep_id'
        ];

        $validator = Validator::make($data, $rules);

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }
    }
}
