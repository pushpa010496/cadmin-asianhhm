<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Shanmuga\LaravelEntrust\Models\EntrustPermission;

//class Permission extends Model
class Permission extends EntrustPermission
{
    protected $fillable=['name','display_name'];
}
