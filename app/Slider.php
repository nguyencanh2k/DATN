<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    public $timestamps = false; //set time to false
    protected $fillable = [
    	'slider_name', 'slider_image','slider_status','slider_title','slider_content','slider_subtitle'
    ];
    protected $primaryKey = 'slider_id';
 	protected $table = 'tbl_slider';
}
