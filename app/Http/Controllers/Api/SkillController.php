<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Skill;
use Illuminate\Http\Request;

class SkillController extends Controller
{
    public function index()
    {
        return Skill::all();
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:128',
        ]);

        $skill = Skill::create($request->all());

        return response()->json($skill, 201);
    }

    public function show(Skill $skill)
    {
        return $skill;
    }

    public function update(Request $request, Skill $skill)
    {
        $request->validate([
            'name' => 'sometimes|required|string|max:128',
        ]);

        $skill->update($request->all());

        return response()->json($skill, 200);
    }

    public function destroy(Skill $skill)
    {
        $skill->delete();

        return response()->json(null, 204);
    }
}
