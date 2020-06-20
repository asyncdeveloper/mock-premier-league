<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\TeamRequest;
use App\Models\Team;

class TeamController extends Controller
{
    public function __construct()
    {
        $this->middleware('jwt.verify')->except('index');
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
