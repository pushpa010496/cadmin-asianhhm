<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SeoPage extends Model
{
    public function Author(){
      return $this->belongsTo('App\Models\User','author_id');
    }
     public function seopages()
  {
    return $this->belongsTo('App\Models\Page','page_id');
  }
}
