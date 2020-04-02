<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Spatie\EloquentSortable\Sortable;
use Spatie\EloquentSortable\SortableTrait;

class Product extends Model implements Sortable
{
    use SortableTrait;

    public $sortable = [
        'order_column_name' => 'order',
        'sort_when_creating' => true,
    ];

    protected $fillable = [
        'id',
        'category_id',
        'codice',
        'prezzo',
        'prezzo_scontato',
        'acquistabile',
        'acquistabile_italfama',
        'stock',
        'availability_id',
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
        'desc_breve_it',
        'desc_breve_en',
        'desc_breve_de',
        'desc_breve_fr',
        'desc_breve_es',
        'desc_breve_ru',
        'misure_it',
        'misure_en',
        'misure_de',
        'misure_fr',
        'misure_es',
        'misure_ru',
        'peso',
        'visibile',
        'italfama',
        'offerta',
        'novita',
        'order',
        'stato'
    ];

    public function category()
    {
        return $this->belongsTo('App\Model\Category');
    }

    public function availability()
    {
        return $this->belongsTo('App\Model\Availability');
    }

}
