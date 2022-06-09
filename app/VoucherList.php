<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VoucherList extends Model
{
   public function item(){
       return $this->hasMany(Item::class);
   }
}
