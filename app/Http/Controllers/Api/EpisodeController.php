<?php

declare(strict_types = 1);

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Schedule;

class EpisodeController extends Controller
{
    /**
     * Construct not used yet, but added for future need and... well, habit.
     */
    public function __construct()
    {
        //
    }

    /**
     * Fetch specific episode
     *
     * Via the Schedule table, get all data pertaining to the specified episode.
     *  - $cuid IS passed as the test APi URL required it, but it's not needed..
     *  - .. due to correct relationships in the Schedule model. default to null
     *
     * I'm using the Episode Controller as it's more the Episode data we're after
     * .. but this could also live in the Schedule controller, as it's getting core data from the Schedule table
     *
     * TODO: Add try/catch error handling
     *
     * @param string $cuid Not used, I don't know how to reference specific route variable names, or I'd remove it
     * @param string $puid Unique reference to this specific showing of this episode, via the schedule table
     *
     * @return object
     */
    public function get(string $cuid = null, string $puid): object
    {
        // Fetch schedule data, based on supplied uid
        $schedule = Schedule::where('uid', $puid)->first();

        // format data to match Api requirements
        $return_array = [
            'uid' => $puid,
            'programme_name' => $schedule->episode->name,
            'programme_description' => $schedule->episode->description,
            'programme_thumbnail' => $schedule->episode->thumbnail,
            'start_time' => $schedule->airdate,
            'end_time' => date("Y-m-d H:i:s", (strtotime($schedule->airdate) + $schedule->episode->duration)),
            'duration' => $schedule->episode->duration,
            'channel' => $schedule->channel->name
        ];

        // return json 200 response
        return response()->json($return_array, 200);
    }
}
