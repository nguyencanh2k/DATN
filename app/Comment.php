<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    public $timestamps = false; //set time to false
    protected $fillable = [
    	'comment_name', 'product_id', 'comment_parent', 'comment', 'comment_date'
    ];
    protected $primaryKey = 'comment_id';
 	protected $table = 'tbl_comments';
     
    public function product(){
        return $this->belongsTo('App\Product','product_id');
    }
}
