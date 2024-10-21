<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Language;
use Illuminate\Http\Request;

class LanguageController extends Controller
{

    public function index()
    {
        return Language::all();
    }


    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:32',
            'level' => 'required|in:beginner,intermediate,advanced,fluent',
        ]);

        $language = Language::create($request->all());

        return response()->json($language, 201);
    }


    public function show(Language $language)
    {
        return response()->json($language);
    }


    public function update(Request $request, Language $language)
    {
        $request->validate([
            'name' => 'sometimes|required|string|max:32',
            'level' => 'sometimes|required|in:beginner,intermediate,advanced,fluent',
        ]);

        $language->update($request->all());

        return response()->json($language, 200);
    }

    public function destroy(Language $language)
    {
        $language->delete();

        return response()->json(['message' => 'Language deleted successfully'], 204);
    }
}
