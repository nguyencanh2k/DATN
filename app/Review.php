<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    public $timestamps = false; //set time to false
    protected $fillable = [
    	'rating', 'comment', 'product_id', 'customer_id', 'order_id', 'review_date'
    ];
    protected $primaryKey = 'review_id';
 	protected $table = 'tbl_reviews';
     
    public function customer(){
        return $this->belongsTo('App\Customer','customer_id');
    }
    public function product(){
        return $this->belongsTo('App\Product','product_id');
    }
}
