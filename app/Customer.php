<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $table = 'customer';

    public function bill()
    {
        // mot customer co 1 bill => one to one (sql:  select * from `bills` where `bills`.`customer_id` = 47 and `bills`.`customer_id` is not null limit 1)
    	return $this->hasOne('App\Bills','customer_id','id');
    }
    public function user()
    {
                                // |foreign_key_customer | primary_key_user   
        return $this->belongsTo('App\User','user_id','id');
    }
}
