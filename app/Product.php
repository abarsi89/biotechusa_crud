<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = false;

    /**
     * The tags that belong to the product.
     */
    public function tags()
    {
        return $this->belongsToMany('App\Tag', 'tag_product');
    }
}
