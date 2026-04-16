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
     * Complete a pedagog's profile after initial registration.
     * Sets department, title, gender, and birth date.
     *
     */
    public function completeStudentProfile(Request $request): JsonResponse
    {
        $user = $request->user();

        if ($user->role !== 'student') {
            return response()->json([
                'success' => false,
                'message' => 'Vetëm studentët mund ta plotësojnë këtë profil.',
            ], 403);
        }

        $user->load('student');
        $student = $user->student;

        if (!$student) {
            return response()->json([
                'success' => false,
                'message' => 'Rekordi i studentit nuk u gjet.',
            ], 404);
        }

        try {
            $validated = $request->validate([
                'stu_atesi'    => 'required|string|max:20',
                'stu_gjini'   => 'required|string|in:M,F',
                'stu_dl'     => 'required|date|before:today',
            ]);
        } catch (ValidationException $e) {
            return response()->json([
                'success' => false,
                'errors'  => $e->errors(),
            ], 422);
        }

        DB::beginTransaction();

        try {
            $student->update([
                'stu_atesi'    => $validated['stu_atesi'],
                'stu_gjini'   => $validated['stu_gjini'],
                'stu_dl'     => $validated['stu_dl'],
            ]);

            $user->load('student');

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
     * Check whether the authenticated user has completed their profile.
     * Frontend uses this to decide whether to show the stepper.
     * Handles both student and pedagog roles.
     *
     */
    public function getProfileStatus(Request $request): JsonResponse
    {
        $user = $request->user();

        if ($user->role === 'student') {
            $user->load('student');
            $student = $user->student;

            if (!$student) {
                return response()->json([
                    'success'     => false,
                    'message'     => 'Rekordi i studentit nuk u gjet.',
                ], 404);
            }

            $isComplete = $student->stu_atesi !== null
                && $student->stu_gjini !== null
                && $student->stu_dl !== null;

            return response()->json([
                'success'     => true,
                'is_complete' => $isComplete,
            ]);
        }

        if ($user->role === 'pedagog') {
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

        return response()->json([
            'success'      => true,
            'is_complete'  => true,
        ]);
    }
}
