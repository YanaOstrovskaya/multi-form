<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Story extends Model
{
    protected $guarded = [];

    public function moments()
    {
        return $this->hasMany(Moment::class);
    }
}
