<?php

use App\Models\Fixture;
use Illuminate\Database\Seeder;

class FixtureSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Fixture::class, 10)->create();
    }
}
