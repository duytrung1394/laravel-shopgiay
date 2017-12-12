<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetailBill extends Model
{
    protected $table = "detail_bill";

    public function bills()
    {
    	return $this->belongsTo("App\Bills","bill_id","id");
    }
    public function product()
    {
    	return $this->belongsTo("App\Product","product_id","id");
    }
    public function size()
    {
    	return $this->belongsTo("App\Size","size_id","id");
    }
}
