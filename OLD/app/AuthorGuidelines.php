<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AuthorGuidelines extends Model
{
    
	protected $guarded = ['id']; 
	
    protected $fillable  = ['title', 'title_tag', 'alt_tag', 'image', 'pdf', 'description', 'url', 'active_flag', 'meta_title', 'meta_keywords', 'meta_description', 'og_title', 'og_description', 'og_keywords', 'og_image', 'og_video', 'meta_region', 'meta_position', 'meta_icbm'];
   
}
