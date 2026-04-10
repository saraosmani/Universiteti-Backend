<?php

namespace App\Http\Controllers;

use App\Services\StudentService;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class StudentController extends Controller
{
    protected StudentService $studentService;

    public function __construct(StudentService $studentService)
    {
        $this->studentService = $studentService;
    }

    /**
     * Display a listing of students.
     */
    public function getAllStudents()
    {
        $students = $this->studentService->getAllStudents();
        
        return response()->json([
            'success' => true,
            'data' => $students
        ], 200);
    }

    /**
     * Store a newly created student.
     */
    public function addStudent(Request $request)
    {
        try {
            $student = $this->studentService->createStudent($request->all());

            return response()->json([
                'success' => true,
                'message' => 'Student u shtua me sukses!',
                'data' => $student
            ], 201);
        } catch (ValidationException $e) {
            return response()->json([
                'success' => false,
                'errors' => $e->errors()
            ], 422);
        }
    }

    /**
     * Display the specified student.
     */
    public function getStudentById($id)
    {
        $student = $this->studentService->getStudentById($id);

        if (!$student) {
            return response()->json([
                'success' => false,
                'message' => 'Student nuk u gjet!'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $student
        ], 200);
    }

    /**
     * Update the specified student.
     */
    public function updateStudent(Request $request, $id)
    {
        try {
            $student = $this->studentService->updateStudent($id, $request->all());

            if (!$student) {
                return response()->json([
                    'success' => false,
                    'message' => 'Student nuk u gjet!'
                ], 404);
            }

            return response()->json([
                'success' => true,
                'message' => 'Student u përditësua me sukses!',
                'data' => $student
            ], 200);
        } catch (ValidationException $e) {
            return response()->json([
                'success' => false,
                'errors' => $e->errors()
            ], 422);
        }
    }

    /**
     * Remove the specified student.
     */
    public function deleteStudent($id)
    {
        $deleted = $this->studentService->deleteStudent($id);

        if (!$deleted) {
            return response()->json([
                'success' => false,
                'message' => 'Student nuk u gjet!'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Student u fshi me sukses!'
        ], 200);
    }
}
