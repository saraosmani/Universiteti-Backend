<?php

namespace App\Http\Controllers;

use App\Models\Pedagog;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class CompleteProfileController extends Controller
{
    /**
     * Complete a pedagog's profile after initial registration.
     * Sets department, title, gender, and birth date.
     *
     * PATCH /api/pedagog/complete-profile
     * Requires: auth:sanctum middleware
     */
    public function completePedagogProfile(Request $request): JsonResponse
    {
        $user = $request->user();

        if ($user->role !== 'pedagog') {
            return response()->json([
                'success' => false,
                'message' => 'Vetëm pedagogët mund ta plotësojnë këtë profil.',
            ], 403);
        }

        $pedagog = $user->pedagog;

        if (!$pedagog) {
            return response()->json([
                'success' => false,
                'message' => 'Rekordi i pedagogut nuk u gjet.',
            ], 404);
        }

        try {
            $validated = $request->validate([
                'dep_id'     => 'required|string|exists:departament,dep_id',
                'ped_tit'    => 'required|string|max:20',
                'ped_gjin'   => 'required|string|in:M,F',
                'ped_dl'     => 'required|date|before:today',
            ]);
        } catch (ValidationException $e) {
            return response()->json([
                'success' => false,
                'errors'  => $e->errors(),
            ], 422);
        }

        DB::beginTransaction();

        try {
            $pedagog->update([
                'dep_id'   => $validated['dep_id'],
                'ped_tit'  => $validated['ped_tit'],
                'ped_gjin' => $validated['ped_gjin'],
                'ped_dl'   => $validated['ped_dl'],
            ]);

            $user->load('pedagog.departament');

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Profili u plotësua me sukses!',
                'data'    => [
                    'user' => $user,
                ],
            ], 200);
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Check whether the authenticated pedagog has completed their profile.
     * Frontend uses this to decide whether to show the stepper.
     *
     * GET /api/pedagogues/profile-status
     * Requires: auth:sanctum middleware
     */
    public function profileStatus(Request $request): JsonResponse
    {
        $user = $request->user();

        if ($user->role !== 'pedagog') {
            return response()->json([
                'success'      => true,
                'is_complete'  => true,
            ]);
        }

        // Explicitly load the pedagog relationship
        $user->load('pedagog');
        $pedagog = $user->pedagog;

        if (!$pedagog) {
            return response()->json([
                'success'     => false,
                'message'     => 'Rekordi i pedagogut nuk u gjet.',
            ], 404);
        }

        $isComplete = $pedagog->dep_id !== null
            && $pedagog->ped_tit !== null
            && $pedagog->ped_gjin !== null
            && $pedagog->ped_dl !== null;

        return response()->json([
            'success'     => true,
            'is_complete' => $isComplete,
        ]);
    }
}
