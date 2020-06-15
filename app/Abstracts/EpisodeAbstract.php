<?php

namespace App\Abstracts;

use App\Models\Schedule;

abstract class EpisodeAbstract
{
    public static function create($puid)
    {
        $schedule = Schedule::where('uid', $puid)->first();
        $return = [];
        // format data to match Api requirements
        $return = [
            'uid' => $puid,
            'programme_name' => $schedule->episode->name,
            'programme_description' => $schedule->episode->description,
            'programme_thumbnail' => $schedule->episode->thumbnail,
            'start_time' => $schedule->airdate,
            'end_time' => date("Y-m-d H:i:s", (strtotime($schedule->airdate) + $schedule->episode->duration)),
            'duration' => $schedule->episode->duration,
            'channel' => $schedule->channel->name
        ];

        return $return;
    }
}
