<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClientAdverts extends Model
{
    protected $guarded = ['id'];

    protected $fillable = ['issue_id','title','title_tag','alt_tag','client_advert_image','client_advert_cover_image','description','url','active_flag','author_id','meta_title','meta_keywords','meta_description','og_title','og_description','og_keywords','og_image','og_video','meta_region','meta_position','meta_icbm'];

    public function issue(){
    	return $this->belongsTo(Issue::class,'issue_id');
    }
}
