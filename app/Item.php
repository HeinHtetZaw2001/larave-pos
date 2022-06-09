<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    public function getcategory(){
        return $this->belongsTo(Category::class,'category_id','id');
    }
}
