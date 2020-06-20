<?php

namespace App\Http\Resources;

use App\Models\Team;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class FixtureResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'match_date' => $this->match_date,
            'team1' => Team::select('id', 'name', 'year_founded')->find($this->team1_id),
            'team2' => Team::select('id', 'name', 'year_founded')->find($this->team2_id)
        ];
    }
}
