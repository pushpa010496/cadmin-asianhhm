<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use SoftDeletes;
class EventOrg extends Model
{
    public function Author(){
      return $this->belongsTo('App\Models\User','author_id');
    }
    public function seoorg(){
      return $this->hasMany('App\Models\SeoEventOrg');
    }
    
}