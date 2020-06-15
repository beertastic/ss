<?php

declare(strict_types = 1);

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Channel;

class ChannelsController extends Controller
{
    /**
     * List all active channels
     *
     * Fetch and filter/format the channel data
     *
     * @return object
     */
    public function index(): object
    {
        // fetch Channel data as collection
        $channels = collect(Channel::all());

        // return json 200 response
        return response()->json($channels, 200);
    }

}
