<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Term extends Model
{
    protected $fillable =['title','sub_title','image','description','term_url','active_flag','title_tag','alt_tag'];
}
