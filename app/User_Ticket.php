<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User_Ticket extends Model
{
  public function user(){

    return $this->belongsTo(User::class, 'user_id');

  }
}
