<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Menu;
class Roleaccess extends Model
{
    protected $fillable = [
       
    ];
    public function menu(){

return $this->belongsTo('App\Models\Menu');


    }
}
