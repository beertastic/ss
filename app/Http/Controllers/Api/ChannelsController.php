<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Channel;
use Illuminate\Http\Request;

class ChannelsController extends Controller
{

    public function __construct()
    {

    }

    public function list()
    {
        $channels = Channel::all();
        return response()->json($channels, 200);
    }

}
