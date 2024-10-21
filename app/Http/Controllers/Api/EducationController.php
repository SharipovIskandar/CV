<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Education;
use Illuminate\Http\Request;

class EducationController extends Controller
{

    public function index()
    {
        return Education::all();
    }


    public function store(Request $request)
    {
        $request->validate([
            'student_id' => 'required|exists:students,id',
            'name' => 'required|string|max:128',
            'description' => 'nullable|string',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
        ]);

        $education = Education::create($request->all());
        return response()->json($education, 201);
    }


    public function show($id)
    {
        $education = Education::findOrFail($id);
        return response()->json($education);
    }


    public function update(Request $request, $id)
    {
        $education = Education::findOrFail($id);

        $request->validate([
            'student_id' => 'required|exists:students,id',
            'name' => 'required|string|max:128',
            'description' => 'nullable|string',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
        ]);

        $education->update($request->all());
        return response()->json($education);
    }


    public function destroy($id)
    {
        $education = Education::findOrFail($id);
        $education->delete();
        return response()->json(null, 204);
    }
}
