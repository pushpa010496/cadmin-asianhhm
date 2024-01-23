<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Online extends Model
{
    protected $fillable =['title','sub_title','title_tag','alt_tag','description','active_flag'];
}
