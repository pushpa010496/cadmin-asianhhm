<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use SoftDeletes;
class Banner extends Model
{

 
    public function Author(){
      return $this->belongsTo('App\Models\User','author_id');
    }
    public function pages(){
    return $this->belongsToMany('App\Models\Page')->withTimestamps();
  }
  public function positions(){
  	return $this->belongsToMany('App\Models\Position')->withTimestamps();
  }
  public function bannerpage()
    {
        return $this->belongsToMany(Page::class,'banner_page','banner_id','page_id')->limit(1);
    }
 public function page()
	{
		return $this->belongsTo(Page::class);
	}
}