<?php

declare(strict_types = 1);

namespace App\Http\Controllers\Api;

use App\Abstracts\EpisodeAbstract;
use App\Http\Controllers\Controller;

class EpisodeController extends Controller
{
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
    public function show(string $cuid = null, string $puid): object
    {
        // prep data format
        $episode = EpisodeAbstract::create($puid);

        // return json 200 response
        return response()->json($episode, 200);
    }
}
