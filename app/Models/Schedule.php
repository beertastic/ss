<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    protected $table = 'schedule';

    public function show(): object
    {
        return $this->belongsTo(Show::class)->orderBy('name')->withPivot('show_id');
    }

    public function channel(): object
    {
        return $this->hasOne(Channel::class, 'id', 'channel_id');
    }

    public function episode()
    {
        return $this->hasOne(Episode::class, 'id', 'episode_id');
    }

}
