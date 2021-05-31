<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User_Ticket extends Model
{
  //  nombre personalizado de la tabla
  protected $table = 'usersTickets';
  protected $primaryKey = 'id';
  protected $fillable = [
    'user_id', 'ticket_id'
  ];

  public function user(){

    return $this->belongsTo(User::class, 'user_id', 'id');

  }

  public function ticket(){
    return $this->belongsTo(Ticket::class, 'ticket_id', 'id');
  }
}
