<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = "product";

    public function category()
    {
    	return $this->belongsTo('App\Category','cate_id','id');
    }
    public function product_properties()
    {
    	return $this->hasMany("App\ProductProperties","product_id","id");
    }
    public function product_image()
    {
    	return $this->hasMany("App\ImageProduct","product_id","id");
    }
}
