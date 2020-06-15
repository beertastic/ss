<?php

namespace App\Abstracts;

use App\Models\Channel;
use App\Models\Schedule;

abstract class ScheduleAbstract
{
    public static function create($cuid, $date, $timezone)
    {
        // check channel is valid
        $channel = Channel::where('uid', $cuid)->first();
        if (!$channel) {
            return response()->json(['error' => 'channel not found'], 404);
        }

        $schedule = Schedule::where('channel_id', $channel->id)
            ->whereDate('airdate', $date)
            ->orderby('airdate', 'ASC')
            ->get();
        $schedule = collect( $schedule );

        $returnSchedule = [];

        // loop through schedule data to format as per Api spec
        foreach ($schedule as $show) {
            $returnSchedule[] =
                [   'uid' => $show->uid,
                    'program_name' => $show->episodeName,
                    'start_time' => $show->airdate,
                    'end_time' => $show->episodeEndTime,
                    'duration' => $show->episodeDuration
                ];
        }
        return $returnSchedule;
    }
}
