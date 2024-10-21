<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index()
    {
        return Project::all();
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:128',
            'description' => 'nullable|string',
            'link' => 'nullable|string|max:512',
            'source_link' => 'nullable|string|max:512',
            'demo_link' => 'nullable|string|max:512',
        ]);

        $project = Project::create($request->all());

        return response()->json($project, 201);
    }

    public function show(Project $project)
    {
        return $project;
    }

    public function update(Request $request, Project $project)
    {
        $request->validate([
            'name' => 'sometimes|required|string|max:128',
            'description' => 'nullable|string',
            'link' => 'nullable|string|max:512',
            'source_link' => 'nullable|string|max:512',
            'demo_link' => 'nullable|string|max:512',
        ]);

        $project->update($request->all());

        return response()->json($project, 200);
    }

    public function destroy(Project $project)
    {
        $project->delete();

        return response()->json(null, 204);
    }
}
