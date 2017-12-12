<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductProperties extends Model
{
     protected $table = "product_properties";

    public function product()
    {
    	return $this->belongsTo("App\Product","product_id","id");
    }
    public function size()
   	{
   		return $this->belongsTo("App\Size","size_id","id");
   	}
}
