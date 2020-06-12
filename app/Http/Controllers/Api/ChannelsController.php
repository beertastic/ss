<?php

declare(strict_types = 1);

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Channel;

class ChannelsController extends Controller
{
    /**
     * Construct not used yet, but added for future need and... well, habit.
     */
    public function __construct()
    {
        //
    }

    /**
     * List all active channels
     *
     * Fetch and filter/format the channel data
     *
     * @return object
     */
    public function list(): object
    {
        // set output data array
        $my_channels = [];

        // fetch all channel data
        $channels = Channel::all();

        // loop and format data to match api requirements
        foreach ($channels as $channel) {
            $my_channels[] = [
                'uid' => $channel->uid,
                'name' => $channel->name,
                'icon' => $channel->logo
            ];
        }

        // return json 200 response
        return response()->json($my_channels, 200);
    }

}
