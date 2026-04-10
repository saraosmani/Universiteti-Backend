<?php

namespace App\Http\Controllers;

use App\Services\DepartamentService;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class DepartamentController extends Controller
{
    protected DepartamentService $departamentService;

    public function __construct(DepartamentService $departamentService)
    {
        $this->departamentService = $departamentService;
    }

    /**
     * Display a listing of departaments.
     */
    public function getAllDepartaments()
    {
        $departaments = $this->departamentService->getAllDepartaments();
        
        return response()->json([
            'success' => true,
            'data' => $departaments
        ], 200);
    }

    /**
     * Store a newly created departament.
     */
    public function addDepartament(Request $request)
    {
        try {
            $departament = $this->departamentService->createDepartament($request->all());

            return response()->json([
                'success' => true,
                'message' => 'Departament created successfully',
                'data' => $departament
            ], 201);
        } catch (ValidationException $e) {
            return response()->json([
                'success' => false,
                'errors' => $e->errors()
            ], 422);
        }
    }

    /**
     * Display the specified departament.
     */
    public function getDepartamentById($id)
    {
        $departament = $this->departamentService->getDepartamentById($id);

        if (!$departament) {
            return response()->json([
                'success' => false,
                'message' => 'Departament not found'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $departament
        ], 200);
    }

    /**
     * Update the specified departament.
     */
    public function updateDepartament(Request $request, $id)
    {
        try {
            $departament = $this->departamentService->updateDepartament($id, $request->all());

            if (!$departament) {
                return response()->json([
                    'success' => false,
                    'message' => 'Departament not found'
                ], 404);
            }

            return response()->json([
                'success' => true,
                'message' => 'Departament updated successfully',
                'data' => $departament
            ], 200);
        } catch (ValidationException $e) {
            return response()->json([
                'success' => false,
                'errors' => $e->errors()
            ], 422);
        }
    }

    /**
     * Remove the specified departament.
     */
    public function deleteDepartament($id)
    {
        $deleted = $this->departamentService->deleteDepartament($id);

        if (!$deleted) {
            return response()->json([
                'success' => false,
                'message' => 'Departament not found'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Departament deleted successfully'
        ], 200);
    }
}