<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MediaPack extends Model
{
    
    protected $guarded = ['id'];

	protected $fillable = ['title', 'title_tag','alt_tag','image','pdf','description','url','active_flag','author_id'];    
}
