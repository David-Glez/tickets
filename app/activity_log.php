<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class activity_log extends Model
{
    protected $table = 'activity_logs';
    protected $primaryKey = 'id';
    protected $fillable = [
      'user', 'action', 'section', 'row_affected', 'description', 'date'
    ];

    public function act(){
      return $this->hasOne(actions::class, 'id', 'action');
    }

    public function usuario(){
      return $this->hasOne(User::class, 'id', 'user');
    }
}
