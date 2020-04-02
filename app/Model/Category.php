<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Spatie\EloquentSortable\Sortable;
use Spatie\EloquentSortable\SortableTrait;

class Category extends Model implements Sortable
{
    use SortableTrait;

    public $sortable = [
        'order_column_name' => 'order',
        'sort_when_creating' => true,
    ];

    protected $fillable = [
        'id',
        'macrocategory_id',
        'nome_it',
        'nome_en',
        'nome_de',
        'nome_fr',
        'nome_es',
        'nome_ru',
        'desc_it',
        'desc_en',
        'desc_de',
        'desc_fr',
        'desc_es',
        'desc_ru',
        'order',
        'stato'
    ];

    public function macrocategory()
    {
        return $this->belongsTo('App\Model\Macrocategory');
    }

    public function product()
    {
        return $this->hasOne('App\Model\Product');
    }

    public function products()
    {
        return $this->hasMany('App\Model\Product');
    }
}
