<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    protected $table = 'schedule';

    // hide un-required fields
    protected $hidden = [
        "id",
        "description",
        "created_at",
        "updated_at",
        "deleted_at"
    ];

    protected $appends = [
        'episodeName',
        'episodeDuration',
        'episodeEndTime'
    ];

    public function show(): object
    {
        return $this->belongsTo(Show::class)->orderBy('name')->withPivot('show_id');
    }

    public function channel(): object
    {
        return $this->hasOne(Channel::class, 'id', 'channel_id');
    }

    public function episode(): object
    {
        return $this->hasOne(Episode::class, 'id', 'episode_id');
    }

    public function getEpisodeNameAttribute(): string
    {
        return $this->episode()->first()->name;
    }

    public function getEpisodeDurationAttribute(): int
    {
        return $this->episode()->first()->duration;
    }

    public function getAirdateAttribute($value): Carbon
    {
        return Carbon::createFromDate($this->value);
    }

    public function getEpisodeEndTimeAttribute(): Carbon
    {
        return Carbon::createFromTimestamp(strtotime($this->getAirdateAttribute($this->airdate)) + ($this->getEpisodeDurationAttribute() ));
    }

}
