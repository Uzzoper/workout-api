<?php

namespace App\Http\Controllers;

use App\Models\Workout;
use Illuminate\Http\Request;

class WorkoutController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $workouts = $request->user()->workouts()->get();
        return response()->json([
            'data' => $workouts
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'scheduled_date' => 'nullable|date',
        ]);

        $workout = $request->user()->workouts()->create($validated);

        return response()->json([
            'message' => 'Treino criado com sucesso!',
            'data' => $workout
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, Workout $workout)
    {
        if ($workout->user_id !== $request->user()->id) {
            return response()->json([
                'message' => 'Acesso não autorizado',
            ], 403);
        }

        $workout->load('exercises');

        return response()->json([
            'data' => $workout
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Workout $workout)
    {
        if ($workout->user_id !== $request->user()->id) {
            return response()->json([
                'message' => 'Acesso não autorizado',
            ], 403);
        }

        $validated = $request->validate([
            'name' => 'sometimes|string|max:255',
            'description' => 'nullable|string',
            'scheduled_date' => 'nullable|date',
        ]);

        $workout->update($validated);

        return response()->json([
            'message' => 'Treino atualizado!',
            'data' => $workout
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Workout $workout)
    {
        if ($workout->user_id !== $request->user()->id) {
            return response()->json([
                'message' => 'Acesso não autorizado',
            ], 403);
        }

        $workout->delete();

        return response()->json([
            'message' => 'Treino deletado!',
        ]);
    }
}
