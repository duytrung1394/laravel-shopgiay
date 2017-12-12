<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = "product";

    public function product_properties()
    {
    	return $this->hasMany("App\ProductProperties","product_id","id");
    }
    public function image_product()
    {
    	return $this->hasMany("App\ImageProduct","product_id","id");
    }
}
