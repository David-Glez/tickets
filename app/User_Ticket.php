<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User_Ticket extends Model
{
  //  nombre personalizado de la tabla
  protected $table = 'usersTickets';

  public function user(){

    return $this->belongsTo(User::class);

  }

  public function ticket(){
    return $this->belongsTo(Ticket::class);
  }
}
