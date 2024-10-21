<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Experience;
use Illuminate\Http\Request;

class ExperienceController extends Controller
{
    public function index()
    {
        return Experience::all();
    }

    public function store(Request $request)
    {
        $request->validate([
            'student_id' => 'required|integer',
            'name' => 'required|string|max:128',
            'position' => 'required|string|max:128',
            'description' => 'nullable|string',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date',
        ]);

        $experience = Experience::create($request->all());

        return response()->json($experience, 201);
    }

    public function show(Experience $experience)
    {
        return $experience;
    }

    public function update(Request $request, Experience $experience)
    {
        $request->validate([
            'student_id' => 'sometimes|required|integer',
            'name' => 'sometimes|required|string|max:128',
            'position' => 'sometimes|required|string|max:128',
            'description' => 'nullable|string',
            'start_date' => 'sometimes|required|date',
            'end_date' => 'nullable|date',
        ]);

        $experience->update($request->all());

        return response()->json($experience, 200);
    }

    public function destroy(Experience $experience)
    {
        $experience->delete();

        return response()->json(null, 204);
    }
}
