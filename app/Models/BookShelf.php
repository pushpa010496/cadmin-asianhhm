<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BookShelf extends Model
{
    protected $table ='book_shelfs';

    protected $fillable =['title','sub_title','no_pages','publisher','publisher_date',
'bookshelf_image','authors','description','url','home_bookshelf','author_id','active_flag','title_tag','alt_tag'];
}
