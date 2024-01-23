<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CaseStudy extends Model
{
    protected $fillable =['title','sub_title','image','pdf','description','url',
'home_casestudies','author_id','active_flag','title_tag','alt_tag','short_description'];
}
