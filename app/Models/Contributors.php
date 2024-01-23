<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contributors extends Model
{
    protected $guarded = ['id'];
      public function issue(){
    	return $this->belongsTo(Issue::class,'issue_id');
    }
    public function category(){
    	return $this->belongsTo(Category::class,'category_id');
    }
   public function editorialarticle(){
    	return $this->belongsTo(Editorialarticle::class,'article_id');
    }
}
