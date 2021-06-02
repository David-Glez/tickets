<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Commits extends Model
{
    use HasFactory;

    protected $table = 'commits';
    protected $fillable = [
        'user_id', 'ticket_id', 'commit'
    ];
}
