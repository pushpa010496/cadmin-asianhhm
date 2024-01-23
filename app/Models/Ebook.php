<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ebook extends Model
{
    protected $guarded = ['id'];
    protected $fillable = ['issue_id','title','ebook_image','magazine_image','image_sm','image_md','ebook_script','script_type','ebook_script_home','topic_1','topic_2','topic_3','topic_4','topic_5','topic_6','url','active_flag','author_id','title_tag','alt_tag','meta_title','meta_keywords','meta_description','og_title','og_description','og_keywords','og_image','og_video','meta_region','meta_position','meta_icbm'];
    public function issue()
    {
    	return $this->belongsTo(Issue::class,'issue_id');
    }
}
