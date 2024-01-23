<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Callender extends Model
{
    protected $guarded = ['id'];

	protected $fillable = ['title','sub_title','title_tag','alt_tag','image','pdf','description','url','active_flag','author_id'];    
}
