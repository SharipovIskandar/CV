<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{

    public function index()
    {
        return Student::all();
    }


    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:32',
            'last_name' => 'required|string|max:32',
            'hhid' => 'required|integer',
            'photo' => 'nullable|string|max:64',
            'phone' => 'nullable|string|max:64',
            'profession' => 'nullable|string|max:100',
            'biography' => 'nullable|string',
        ]);

        $student = Student::create($request->all());

        return response()->json($student, 201);
    }


    public function show(Student $student)
    {
        return $student;
    }


    public function update(Request $request, Student $student)
    {
        $request->validate([
            'first_name' => 'sometimes|required|string|max:32',
            'last_name' => 'sometimes|required|string|max:32',
            'hhid' => 'sometimes|required|integer',
            'photo' => 'nullable|string|max:64',
            'phone' => 'nullable|string|max:64',
            'profession' => 'nullable|string|max:100',
            'biography' => 'nullable|string',
        ]);

        $student->update($request->all());

        return response()->json($student, 200);
    }


    public function destroy(Student $student)
    {
        $student->delete();

        return response()->json(null, 204);
    }
}
