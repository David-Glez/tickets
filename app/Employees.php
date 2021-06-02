<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employees extends Model
{
    use HasFactory;
    
    protected $table = 'employees';
    protected $fillable = [
        'user_id', 'names', 'last_name', 'department'
    ];
}
