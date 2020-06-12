<?php

declare(strict_types = 1);

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Channel;
use App\Models\Episode;
use App\Models\Schedule;

class ScheduleController extends Controller
{
    /**
     * Construct not used yet, but added for future need and... well, habit.
     */
    public function __construct()
    {
        //
    }

    /**
     * Get channel schedule for specific date
     *
     * Based on supplied channel id ($cuid) return all scheduled shows in chronological order and format data
     *
     * @param string $cuid uid of Channel table
     * @param string $date YYYY-mm-dd format date
     * TODO: create a new type class to correctly handle the date provided, and not string
     *
     * @return object
     */
    public function list(string $cuid, string $date, $timezone = 0): object
    {
        // set return data array
        $return_schedule = [];

        // fetch requested channel data
        $channel = Channel::where('uid', $cuid)->get();

        // check channel is valid
        // TODO replace with cleaner try/catch, for better error logging
        if (count($channel) <= 0) {
            return response()->json(['error' => 'channel not found'], 404);
        }

        // fetch all schedule data for requested channel
        $schedule = Schedule::where('channel_id', $channel[0]->id)
            ->whereDate('airdate', '=', $date)
            ->orderby('airdate', 'ASC')
            ->get();

        // loop through schedule data to format as per Api spec
        foreach ($schedule as $show) {
            $episode = Episode::find($show->episode_id);
            $return_schedule[] =
                [   'uid' => $show->uid,
                    'program_name' => $episode->name,
                    'start_time' => $show->airdate,
                    'end_time' => date("Y-m-d H:i:s", (strtotime($show->airdate) + ($episode->duration))),
                    'duration' => $episode->duration
                ];
        }

        // return json 200 response
        return response()->json($return_schedule, 200);
    }

}
