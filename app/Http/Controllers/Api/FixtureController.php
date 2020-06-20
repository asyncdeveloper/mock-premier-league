<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\FixtureRequest;
use App\Models\Fixture;

class FixtureController extends Controller
{

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

}
