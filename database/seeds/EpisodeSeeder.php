<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\Episode;

class EpisodeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($show = 1; $show <= 8; $show++) {
            for($s = 1; $s <= rand(2,6); $s++) {
                for ($e = 1; $e <= rand(6,12); $e++) {
                    factory(Episode::class)->create([
                        'show_id' => $show,
                        'season' => $s,
                        'episode' => $e,
                    ]);
                }
            }
        }
    }
}
