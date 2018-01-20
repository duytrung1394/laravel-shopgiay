<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bills extends Model
{
    protected $table = "bills";

    public function customer()
    {
    	return $this->belongsTo('App\Customer','customer_id','id');
    }
    public function billdetail()
    {
    	return $this->hasMany("App\DetailBill","bill_id","id");
    }
    public function coupon()
    {
    	return $this->belongsTo('App\Coupon','coupon_id','id');
    }
}
