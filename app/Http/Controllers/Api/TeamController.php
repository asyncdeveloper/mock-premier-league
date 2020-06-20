<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\TeamRequest;
use App\Http\Resources\TeamResource;
use App\Models\Team;

class TeamController extends Controller
{
    public function __construct()
    {
        $this->middleware('jwt.verify')->except('index');
    }

    public function index()
    {
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

}
