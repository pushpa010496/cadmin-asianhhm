<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Advertiser extends Model
{
    protected $fillable = ['title','category_id','image','title_tag','alt_tag',
'active_flag'];



public function category(){

	return $this->belongsTo('App\Category');
}
}
