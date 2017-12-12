<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Size extends Model
{
    protected $table = "size";

    public function product_properties()
    {
    	return $this->hasMany("App\ProductProperties","size_id","id");
    }
}
