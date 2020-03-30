<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Url extends Model
{
    protected $fillable = [
        'locale',
        'slug',
    ];

    public function urlable()
    {
        return $this->morphTo();
    }

    public function domain()
    {
        return $this->belongsTo('App\Model\Domain');
    }

}
