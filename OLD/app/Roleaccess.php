<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Menu;
class Roleaccess extends Model
{
    protected $fillable = [
       
    ];
    public function menu(){

return $this->belongsTo('App\Menu');


    }
}
