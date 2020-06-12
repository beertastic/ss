<?php

use Illuminate\Database\Seeder;
use App\Models\Channel;
use App\Models\Episode;

class ScheduleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // set key and base variables for seeding
        $new_schedule = [];
        $time_start = time();
        $total_time = 0;
        $prev_end = 0;
        $channels = Channel::all();

        // let's populate some fake schedules, one channel at a time
        foreach ($channels as $channel) {

            $days_to_populate = 1;
            while($total_time < (86400 * $days_to_populate)) {
                // grab a random show from Episode table
                $episode = Episode::get()->random(1);

                // calculate total time tally to avoid going over the required time
                $total_time += ($episode[0]->duration + 180);

                // TODO: allow seeder to better defined create start/end dates for a schedule

                $time_start = $time_start + $prev_end;
                $new_schedule[] = [
                    'uid' => uniqid(),
                    'channel_id' => $channel->id,
                    'episode_id' => $episode[0]->id,
                    'airdate' => date("Y-m-d H:i:s", $time_start)
                ];

                // add a 3 min break between shows and set the duration needed for new show to appear
                $prev_end = $episode[0]->duration + 180;
                // TODO: round up to nearest minute.. or 5 mins etc?
            }

            // loop through the scheduled shows and add them
            foreach ($new_schedule as $new_show) {
                DB::table('schedule')->insert($new_show);
            }

            // reset key variables for the new channel and begin next loop
            $new_schedule = [];
            $total_time = 0;
            $time_start = time();

        }
    }
}
