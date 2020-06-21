<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = false;
    
    /**
     * The products that belong to the tag.
     */
    public function products()
    {
        return $this->belongsToMany('App\Product', 'tag_product');
    }
}
