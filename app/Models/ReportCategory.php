<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReportCategory extends Model
{
	 protected $fillable = [
        'title','url','description','active_flag'
    ];
      protected $guarded = [
        'id'
    ];
}
