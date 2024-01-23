<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use SoftDeletes;
class Position extends Model{
	protected $gaurded=['id'];
    protected $parent = 'parent_id';

    public function Author(){
      return $this->belongsTo('App\Models\User','author_id');
    }
   	public function sliders(){
	    return $this->belongsToMany('App\Models\Slider','position_slider','position_id','slider_id')->withTimestamps();
	}
	public function banners(){
	    return $this->belongsToMany('App\Models\Banner','position_banner','position_id','banner_id')->withTimestamps();
	}
	public function seop(){

		return $this->hasOne('App\Models\SeoPage');

	}
}