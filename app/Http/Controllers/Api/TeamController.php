<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\TeamRequest;
use App\Http\Resources\TeamResource;
use App\Models\Team;
use Illuminate\Http\Request;

class TeamController extends Controller
{
    public function __construct()
    {
        $this->middleware('jwt.verify')->except('index');
    }

    public function index(Request $request)
    {
        if($request->paginate === 'false') {
            return TeamResource::collection(Team::all());
        }
        return TeamResource::collection(Team::paginate());
    }

    public function show(Team $team)
    {
        return new TeamResource($team);
    }
    
    public function store(TeamRequest $request)
    {
        $data = $request->validated();

        Team::create($data);

        return response()->json([
            'message' => 'Team created successfully.'
        ], 201);
    }

    public function update(TeamRequest $request, Team $team)
    {
        $data = $request->validated();

        $team->update($data);

        return response()->json([
            'message' => 'Team updated successfully.'
        ]);
    }

    public function destroy(Team $team)
    {
        $team->delete();

        return response()->noContent();
    }

}
