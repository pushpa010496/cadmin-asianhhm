<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\Roleaccess;

class Menu extends Model
{
    
    protected $fillable = [
        'label', 'link',
    ];


    public function Roleaccess(){

return $this->hasMany('App\Roleaccess');


    }
}
