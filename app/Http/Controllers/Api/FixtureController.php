<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\FixtureRequest;
use App\Http\Resources\FixtureResource;
use App\Models\Fixture;

class FixtureController extends Controller
{

    public function __construct()
    {
        $this->middleware('jwt.verify')->except('index');
    }

    public function index()
    {
        return FixtureResource::collection(Fixture::paginate());
    }

    public function show(Fixture $fixture)
    {
        return new FixtureResource($fixture);
    }

    public function store(FixtureRequest $request)
    {
        $data = $request->validated();

        $fixture = Fixture::firstOrNew([
            'team1_id' => $data['team1_id'],
            'team2_id' => $data['team2_id'],
            'match_date' => $data['match_date']
        ], [ 'title' => $data['title'] ]);

        if ($fixture->exists) {
            return response()->json([
              'errors' => 'Fixture with both teams at that time already exist.'
            ], 422);
        }

        $fixture->save();

        return response()->json([
          'message' => 'Fixture created successfully.'
        ], 201);
    }

    public function update(FixtureRequest $request, Fixture $fixture)
    {
        $data = $request->validated();

        $fixtureCount = Fixture::where([
            [ 'team1_id', '=', $data['team1_id'] ?? $fixture->team1_id ],
            [ 'team2_id', '=', $data['team2_id'] ?? $fixture->team2_id ],
            [ 'id', '!=', $fixture->id ],
            [ 'match_date', '=', $data['match_date'] ?? $fixture->match_date ]
        ])->count();

        if($fixtureCount > 0) {
            return response()->json([
                'errors' => 'Fixture with both teams at that time already exist.'
            ], 422);
        }

        $fixture->update($data);

        return response()->json([
            'message' => 'Team updated successfully.'
        ]);
    }

}
