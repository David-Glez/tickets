<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectFiles extends Model
{
    use HasFactory;
    protected $table = 'project_files';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id_ticket', 'path'
    ];
}
