<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TargetAudience extends Model
{
   protected $fillable =['title','sub_title','image','pdf','description','target_url','active_flag','title_tag','alt_tag'];
}
