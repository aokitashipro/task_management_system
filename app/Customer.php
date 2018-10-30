<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    //
    
    //
    public function tasks()
    {
      return $this->hasMany('App\Task');
    }

}
