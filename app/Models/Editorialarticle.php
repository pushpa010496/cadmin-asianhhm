<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Editorialarticle extends Model
{
	protected $table = 'editorial_articles';
    protected $guarded = ['id'];


    public function issue(){
    	return $this->belongsTo(Issue::class,'issue_id');
    }

    public function category(){
    	return $this->belongsTo(Category::class,'category_id');
    }
   
     public function authors(){
    	return $this->belongsToMany('App\Models\Contributors')->withTimestamps();
    }

     
}
