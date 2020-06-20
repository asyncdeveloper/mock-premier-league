<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Fixture extends Model
{

    protected $fillable = [ 'title', 'match_date', 'team1_id', 'team2_id' ];


}
