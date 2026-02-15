<?php

namespace App\Http\Controllers;

use App\Models\Exercise;
use App\Models\Workout;
use Illuminate\Http\Request;


class ExerciseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, Workout $workout)
    {
        if ($workout->user_id !== $request->user()->id) {
            return response()->json([
                'message' => 'Acesso não autorizado',
            ], 403);
        }

        return response()->json([
            'data' => $workout->exercises
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Workout $workout)
    {
        if ($workout->user_id !== $request->user()->id) {
            return response()->json([
                'message' => 'Acesso não autorizado',
            ], 403);
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'sets' => 'required|integer|min:1',
            'reps' => 'required|integer|min:1',
            'weight' => 'nullable|numeric',
            'position' => 'nullable|integer',
            'rest_time' => 'nullable|integer',
            'notes' => 'nullable|string',
        ]);

        $exercise = $workout->exercises()->create($validated);

        return response()->json([
            'message' => 'Exercício criado!',
            'data' => $exercise
        ], 201);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Exercise $exercise)
    {
        if ($exercise->workout->user_id !== $request->user()->id) {
            return response()->json([
                'message' => 'Acesso não autorizado',
            ], 403);
        }

        $validated = $request->validate([
            'name' => 'sometimes|string|max:255',
            'sets' => 'sometimes|integer|min:1',
            'reps' => 'sometimes|integer|min:1',
            'weight' => 'nullable|numeric',
            'position' => 'nullable|integer',
            'rest_time' => 'nullable|integer',
            'notes' => 'nullable|string',
        ]);

        $exercise->update($validated);

        return response()->json([
            'message' => 'Exercício atualizado!',
            'data' => $exercise
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Exercise $exercise)
    {
        if ($exercise->workout->user_id !== $request->user()->id) {
            return response()->json([
                'message' => 'Acesso não autorizado',
            ], 403);
        }

        $exercise->delete();

        return response()->json([
            'message' => 'Exercício deletado!',
        ]);
    }
}
