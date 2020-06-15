<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Channel extends Model
{
    use SoftDeletes;

    // hide un-required fields
    protected $hidden = [
        "id",
        "description",
        "created_at",
        "updated_at",
        "deleted_at"
    ];

    public function shows(): object
    {
        return $this->hasMany(Show::class)->orderBy('name');
    }

}
