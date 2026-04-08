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
    }

    public function getAllPedagogues()
    {
        $pedagogues = $this->pedagogService->getAllPedagogues();
        return response()->json(['success' => true, 'data' => $pedagogues], 200);
    }

    public function addPedagogue(Request $request)
    {
        try {
            $pedagog = $this->pedagogService->createPedagogue($request->all());
            return response()->json(['success' => true, 'message' => 'Pedagog u krijua', 'data' => $pedagog], 201);
        } catch (ValidationException $e) {
            return response()->json(['success' => false, 'errors' => $e->errors()], 422);
        }
    }

    public function getPedagogueById($id)
    {
        $pedagog = $this->pedagogService->getPedagogueById($id);
        if (!$pedagog) return response()->json(['success' => false, 'message' => 'Nuk u gjend'], 404);
        return response()->json(['success' => true, 'data' => $pedagog], 200);
    }
}