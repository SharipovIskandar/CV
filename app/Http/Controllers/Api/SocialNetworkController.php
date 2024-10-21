<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\SocialNetwork;
use Illuminate\Http\Request;

class SocialNetworkController extends Controller
{

    public function index()
    {
        return SocialNetwork::all();
    }


    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'link' => 'required|url|max:255',
        ]);

        $socialNetwork = SocialNetwork::create($request->all());
        return response()->json($socialNetwork, 201);
    }


    public function show(SocialNetwork $socialNetwork)
    {
        return response()->json($socialNetwork);
    }


    public function update(Request $request, SocialNetwork $socialNetwork)
    {
        $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'link' => 'sometimes|required|url|max:255',
        ]);

        $socialNetwork->update($request->all());
        return response()->json($socialNetwork, 200);
    }


    public function destroy(SocialNetwork $socialNetwork)
    {
        $socialNetwork->delete();
        return response()->json(null, 204);
    }
}
