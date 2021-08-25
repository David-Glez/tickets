<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class actions extends Model
{
    protected $table = 'actions';
    protected $primaryKey = 'id';
    protected $fillable = [
      'name'
    ];
    
}
