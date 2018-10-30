<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    //
    public function customer()
    {
      return $this->belongsTo('App\Customer');
    }

    public function member()
    {
      return $this->belongsTo('App\Member');
    }

    public function category()
    {
      return $this->belongsTo('App\Category');
    }
}
