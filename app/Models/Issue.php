<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Issue extends Model
{
    protected $gaurded = ['id'];

    protected $fillable = ['title', 'issue_no', 'category','active_flag'];

     public function categories(){
    	return $this->belongsToMany('App\Models\Category')->withTimestamps();
    }
}
