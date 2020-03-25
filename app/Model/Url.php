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

    public function page()
    {
        return $this->belongsTo('App\Model\Page');
    }

    public function pages()
    {
        return $this->belongsToMany('App\Model\Page');
    }
}
