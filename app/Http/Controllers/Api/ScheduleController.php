<?php

declare(strict_types = 1);

namespace App\Http\Controllers\Api;

use App\Abstracts\ScheduleAbstract;
use App\Http\Controllers\Controller;

use Carbon\Carbon;

class ScheduleController extends Controller
{
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
    public function show(string $cuid, Carbon $date, $timezone = 0): object
    {
        // prep data format
        $schedule = ScheduleAbstract::create($cuid, $date, $timezone);

        // return json 200 response
        return response()->json($schedule, 200);
    }

}
