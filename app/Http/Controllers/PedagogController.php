<?php

namespace App\Http\Controllers;

use App\Services\PedagogService;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class PedagogController extends Controller
{
    protected PedagogService $pedagogService;

    public function __construct(PedagogService $pedagogService)
    {
        $this->pedagogService = $pedagogService;

        $this->middleware('auth:sanctum');

        // AUTHORIZATION: Vetem admini mund te beje ndryshime ose shtime/fshirje 
        $this->middleware('check.role:admin')->only([
            'addPedagogue', 
            'updatePedagogue', 
            'deletePedagogue'
        ]);
    }

    public function getAllPedagogues()
    {
        $pedagogues = $this->pedagogService->getAllPedagogues();
        return response()->json([
            'success' => true, 
            'data' => $pedagogues
        ], 200);
    }

    public function addPedagogue(Request $request)
    {
        try {
            $pedagog = $this->pedagogService->createPedagogue($request->all());
            return response()->json([
                'success' => true, 
                'message' => 'Pedagogu u shtua me sukses', 
                'data' => $pedagog
            ], 201);
        } catch (ValidationException $e) {
            return response()->json([
                'success' => false, 
                'errors' => $e->errors()
            ], 422);
        }
    }

    public function getPedagogueById($id)
    {
        $pedagog = $this->pedagogService->getPedagogueById($id);

        if (!$pedagog) {
            return response()->json([
                'success' => false, 
                'message' => 'Pedagogu nuk u gjend'
            ], 404);
        }

        return response()->json([
            'success' => true, 
            'data' => $pedagog
        ], 200);
    }

    public function updatePedagogue(Request $request, $id)
    {
        try {
            $pedagog = $this->pedagogService->updatePedagogue($id, $request->all());
            if (!$pedagog) {
                return response()->json([
                    'success' => false, 
                    'message' => 'Pedagogu nuk u gjend'
                ], 404);
            }
            return response()->json([
                'success' => true, 
                'message' => 'Të dhënat u përditësuan', 
                'data' => $pedagog
            ], 200);
        } catch (ValidationException $e) {
            return response()->json([
                'success' => false, 
                'errors' => $e->errors()
            ], 422);
        }
    }

    public function deletePedagogue($id)
    {
        if ($this->pedagogService->deletePedagogue($id)) {
            return response()->json([
                'success' => true, 
                'message' => 'Pedagogu u fshi me sukses'
            ], 200);
        }
        return response()->json([
            'success' => false, 
            'message' => 'Pedagogu nuk u gjend'
        ], 404);
    }
}