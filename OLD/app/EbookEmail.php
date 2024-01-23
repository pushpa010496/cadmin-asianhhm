<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EbookEmail extends Model
{
    protected $guarded=['id'];
    protected $fillable=['issue_id','email'];
}
