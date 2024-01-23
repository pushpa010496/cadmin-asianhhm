<?php

namespace App\Models\Models;

use Illuminate\Database\Eloquent\Model;

use App\Models\Roleaccess;

class Menu extends Model
{
    
    protected $fillable = [
        'label', 'link',
    ];


    public function Roleaccess(){

return $this->hasMany('App\Models\Models\Roleaccess');


    }
}
