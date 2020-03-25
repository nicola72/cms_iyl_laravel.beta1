<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    protected $fillable = [
        'nome',
    ];

    public function urls()
    {
        return $this->morphTo('App\Model\Url','urlable');
    }
}
